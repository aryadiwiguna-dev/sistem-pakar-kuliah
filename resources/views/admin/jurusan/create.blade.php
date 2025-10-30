@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Tambah Jurusan Baru</h1>
            <p class="mt-2 text-gray-600">Lengkapi formulir di bawah ini untuk menambahkan jurusan baru ke dalam sistem.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-xl rounded-2xl">
            <form action="{{ route('admin.jurusan.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Nama Jurusan -->
                <div>
                    <label for="nama_jurusan" class="block text-sm font-semibold text-gray-700 mb-2">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" id="nama_jurusan" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" placeholder="Contoh: Teknik Informatika" required>
                    @error('nama_jurusan') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Jurusan</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" placeholder="Jelaskan secara singkat apa yang dipelajari di jurusan ini." required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Prospek Kerja -->
                <div>
                    <label for="prospek_kerja" class="block text-sm font-semibold text-gray-700 mb-2">Prospek Kerir</label>
                    <textarea name="prospek_kerja" id="prospek_kerja" rows="3" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" placeholder="Sebutkan beberapa contoh pekerjaan yang bisa dijalankan." required>{{ old('prospek_kerja') }}</textarea>
                    @error('prospek_kerja') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Kampus Rekomendasi -->
                <div>
                    <label for="kampus_rekomendasi" class="block text-sm font-semibold text-gray-700 mb-2">Kampus Rekomendasi</label>
                    <p class="text-xs text-gray-500 mb-2">Pisahkan nama kampus dengan koma (,).</p>
                    <input type="text" name="kampus_rekomendasi" id="kampus_rekomendasi" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" placeholder="Contoh: UI, ITB, UGM, ITS" required>
                    @error('kampus_rekomendasi') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end items-center space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.jurusan.index') }}" class="text-gray-700 bg-white hover:bg-gray-50 font-medium py-2.5 px-6 rounded-lg border border-gray-300 transition duration-150 ease-in-out">Batal</a>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Jurusan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection