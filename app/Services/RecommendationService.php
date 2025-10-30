<?php

namespace App\Services;

use App\Models\Jurusan;
use App\Models\Jawaban;

class RecommendationService
{
    /**
     * Menghitung rekomendasi jurusan berdasarkan jawaban user.
     *
     * @param array $facts
     * @return array
     */
    public function getRecommendations(array $facts): array
    {
        // Inisialisasi skor dan alasan untuk setiap jurusan
        $jurusanData = Jurusan::pluck('id')->flip()->map(fn($jurusanId) => [
            'score' => 0,
            'reasons' => []
        ])->all();

        foreach ($facts as $questionId => $answer) {
            // Cari semua jawaban yang cocok
            $matchingJawabans = Jawaban::where('pertanyaan_id', $questionId)
                ->where('opsi_jawaban', $answer)
                ->get();

            // Tambahkan skor dan alasan berdasarkan bobot
            foreach ($matchingJawabans as $jawaban) {
                $jurusanId = $jawaban->jurusan_id;
                // PERBAIKAN: Gunakan 'bobot' bukan 'weight'
                $scoreToAdd = $jawaban->bobot * 1; // Setiap jawaban benar mendapat dasar skor 1, dikalikan dengan bobot

                if (isset($jurusanData[$jurusanId])) {
                    $jurusanData[$jurusanId]['score'] += $scoreToAdd;
                    // Tambahkan alasan ke dalam array
                    $jurusanData[$jurusanId]['reasons'][] = $jawaban->conclusion_reason;
                }
            }
        }

        // Urutkan berdasarkan skor tertinggi
        uasort($jurusanData, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Format hasil akhir
        $recommendations = collect($jurusanData)
            ->filter(fn($item) => $item['score'] > 0)
            ->take(5)
            ->map(function ($item, $jurusanId) {
                $jurusan = Jurusan::find($jurusanId);
                return [
                    'jurusan' => $jurusan,
                    'skor_akhir' => $item['score'],
                    'alasan' => implode(' ', array_unique($item['reasons'])) // Gabungkan semua alasan, hapus duplikat
                ];
            })->values()->all();

        return $recommendations;
    }
}
