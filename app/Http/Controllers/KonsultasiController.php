<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use Illuminate\Http\Request;
use App\Models\RiwayatKonsultasi;
use Illuminate\Support\Facades\Auth;
use App\Models\Pertanyaan;

class KonsultasiController extends Controller
{
    public function index()
    {
        // Pastikan query ini berhasil dan mengembalikan data
        $pertanyaans = Pertanyaan::with('jawabans')->get();

        // Debug untuk memastikan data ada
        if ($pertanyaans->isEmpty()) {
            // Jika tidak ada pertanyaan, Anda bisa redirect atau tampilkan pesan
            return redirect()->route('home')->with('error', 'Belum ada pertanyaan yang tersedia.');
        }

        return view('konsultasi.form', compact('pertanyaans'));
    }

    public function process(Request $request)
    {
        // PERBAIKAN: Ambil hanya data jawaban
        $userAnswers = $request->input('jawaban', []);

        // Debug: Tampilkan jawaban yang diterima
        // dd($userAnswers);

        $service = new RecommendationService();
        $results = $service->getRecommendations($userAnswers);

        // Simpan ke riwayat jika user login
        if (Auth::check()) {
            RiwayatKonsultasi::create([
                'user_id' => Auth::id(),
                'hasil' => [
                    'rekomendasi' => $results,
                    'jawaban_user' => $userAnswers
                ]
            ]);
        }

        return view('konsultasi.hasil', compact('results'));
    }
}
