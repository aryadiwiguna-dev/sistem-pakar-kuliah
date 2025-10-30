<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PertanyaanController extends Controller
{
    // Menampilkan daftar pertanyaan
    public function index()
    {
        $pertanyaans = Pertanyaan::withCount('jawabans')->latest()->paginate(10);
        return view('admin.pertanyaan.index', compact('pertanyaans'));
    }

    // Menampilkan form tambah pertanyaan
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('admin.pertanyaan.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        // Validasi data pertanyaan
        $validatedPertanyaan = $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jenis_pertanyaan' => 'required|in:pilihan_ganda,skala,input_angka',
        ]);

        // Validasi input jawaban
        $request->validate([
            'jawabans' => 'required|array|min:2',
            'jawabans.*.opsi_jawaban' => 'required|string|max:255',
            'jawabans.*.jurusan_id' => 'required|exists:jurusans,id',
            'jawabans.*.bobot' => 'required|integer|min:1|max:5',
            'jawabans.*.conclusion_reason' => 'required|string|max:255',
        ]);

        // Simpan pertanyaan
        $pertanyaan = Pertanyaan::create($validatedPertanyaan);

        // Simpan jawaban
        foreach ($request->jawabans as $jawabanData) {
            $pertanyaan->jawabans()->create([
                'jurusan_id' => $jawabanData['jurusan_id'],
                'opsi_jawaban' => $jawabanData['opsi_jawaban'],
                'bobot' => $jawabanData['bobot'],
                'conclusion_reason' => $jawabanData['conclusion_reason'],
            ]);
        }

        return redirect()->route('admin.pertanyaan.index')->with('success', 'Pertanyaan dan jawaban berhasil ditambahkan!');
    }

    public function edit(Pertanyaan $pertanyaan)
    {
        $jurusans = Jurusan::all();

        // Debug: Periksa apakah ada jawaban
        Log::info('Jumlah jawaban: ' . $pertanyaan->jawabans()->count());

        // Format data yang sudah siap pakai untuk Alpine.js
        $jawabansFormatted = $pertanyaan->jawabans->map(function ($item) {
            return [
                'id' => $item->id,
                'opsi_jawaban' => $item->opsi_jawaban,
                'jurusan_id' => $item->jurusan_id,
                'bobot' => $item->bobot,
                'conclusion_reason' => $item->conclusion_reason,
            ];
        })->toArray();

        // Debug
        Log::info('Pertanyaan Asli: ' . $pertanyaan->getOriginal('pertanyaan'));
        Log::info('Jawabans Formatted: ' . json_encode($jawabansFormatted));

        return view('admin.pertanyaan.edit', [
            'pertanyaan' => $pertanyaan,
            'jurusans' => $jurusans,
            'jawabansFormatted' => $jawabansFormatted
        ]);
    }

    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        // Validasi data pertanyaan
        $validatedPertanyaan = $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jenis_pertanyaan' => 'required|in:pilihan_ganda,skala,input_angka',
        ]);

        // Update pertanyaan
        $pertanyaan->update($validatedPertanyaan);

        // Hapus semua jawaban lama untuk pertanyaan ini
        $pertanyaan->jawabans()->delete();

        // Validasi dan simpan jawaban baru
        $request->validate([
            'jawabans' => 'required|array|min:2',
            'jawabans.*.opsi_jawaban' => 'required|string|max:255',
            'jawabans.*.jurusan_id' => 'required|exists:jurusans,id',
            'jawabans.*.bobot' => 'required|integer|min:1|max:5',
            'jawabans.*.conclusion_reason' => 'required|string|max:255',
        ]);

        foreach ($request->jawabans as $jawabanData) {
            $pertanyaan->jawabans()->create([
                'jurusan_id' => $jawabanData['jurusan_id'],
                'opsi_jawaban' => $jawabanData['opsi_jawaban'],
                'bobot' => $jawabanData['bobot'],
                'conclusion_reason' => $jawabanData['conclusion_reason'],
            ]);
        }

        return redirect()->route('admin.pertanyaan.index')->with('success', 'Pertanyaan dan jawaban berhasil diperbarui!');
    }

    // Menghapus pertanyaan dan semua jawabannya
    public function destroy(Pertanyaan $pertanyaan)
    {
        // Karena sudah ada onDelete('cascade') di migration, jawaban akan terhapus otomatis
        $pertanyaan->delete();
        return redirect()->route('admin.pertanyaan.index')->with('success', 'Pertanyaan berhasil dihapus!');
    }
}
