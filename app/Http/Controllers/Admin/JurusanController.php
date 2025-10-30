<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    // Menampilkan daftar jurusan (sudah ada)
    public function index()
    {
        $jurusans = Jurusan::latest()->paginate(10);
        return view('admin.jurusan.index', compact('jurusans'));
    }

    // Menampilkan form tambah jurusan (sudah ada)
    public function create()
    {
        return view('admin.jurusan.create');
    }

    // Menyimpan jurusan baru (sudah ada)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jurusan' => 'required|string|unique:jurusans,nama_jurusan',
            'deskripsi' => 'required|string',
            'prospek_kerja' => 'required|string',
            'kampus_rekomendasi' => 'required|string', // Nama field dengan spasi
        ]);

        // Proses string menjadi array JSON
        $kampusArray = explode(',', $validated['kampus_rekomendasi']);
        $validated['kampus_rekomendasi'] = json_encode(array_map('trim', $kampusArray));

        Jurusan::create($validated);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan!');
    }
    // Menampilkan detail satu jurusan (opsional, bisa kita lewati dulu)
    public function show(Jurusan $jurusan)
    {
        //
    }

    // --- TAMBAHKAN METODE EDIT INI ---
    public function edit(Jurusan $jurusan)
    {
        // Decode JSON kembali menjadi array untuk ditampilkan di form
        $jurusan->kampus_rekomendasi = json_decode($jurusan->kampus_rekomendasi);
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    // --- TAMBAHKAN METODE UPDATE INI ---
    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'nama_jurusan' => 'required|string|unique:jurusans,nama_jurusan,' . $jurusan->id,
            'deskripsi' => 'required|string',
            'prospek_kerja' => 'required|string',
            'kampus_rekomendasi' => 'required|string', // Nama field dengan spasi
        ]);

        // Proses string menjadi array JSON
        $kampusArray = explode(',', $validated['kampus rekomendasi']);
        $validated['kampus_rekomendasi'] = json_encode(array_map('trim', $kampusArray));

        $jurusan->update($validated);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diperbarui!');
    }

    // --- TAMBAHKAN METODE DESTROY INI ---
    public function destroy(Jurusan $jurusan)
    {
        // Karena ada foreign key constraint, kita perlu menghapus data yang terkait
        // atau setidaknya memastikan tidak ada error. Untuk sekarang, kita akan coba hapus langsung.
        // Jika ada error, kita akan menanganinya dengan 'cascade delete' di migration.
        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dihapus!');
    }
}
