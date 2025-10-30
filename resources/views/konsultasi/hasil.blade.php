@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 bg-gray-100">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Hasil Rekomendasi Jurusan Untuk Anda</h2>
        </div>
        
        @forelse ($results as $result)
            <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $result['jurusan']->nama_jurusan }}</h3>
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            Skor: {{ $result['skor_akhir'] }}
                        </span>
                    </div>
                    <div class="space-y-3 text-gray-600">
                        <p><strong class="text-gray-900">Deskripsi:</strong> {{ $result['jurusan']->deskripsi }}</p>
                        <p><strong class="text-gray-900">Prospek Karir:</strong> {{ $result['jurusan']->prospek_kerja }}</p>
                        <p><strong class="text-gray-900">Kampus Rekomendasi:</strong> {{ implode(', ', json_decode($result['jurusan']->kampus_rekomendasi)) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                <h3 class="text-lg font-medium text-yellow-800">Maaf, Kami Belum Bisa Memberikan Rekomendasi</h3>
                <p class="mt-2 text-yellow-700">Berdasarkan jawaban Anda, tidak ada jurusan yang cocok. Coba ulangi tes.</p>
            </div>
        @endforelse

        <div class="text-center mt-8">
            <a href="{{ route('konsultasi.form') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">
                Uji Lagi
            </a>
        </div>
    </div>
</div>
@endsection