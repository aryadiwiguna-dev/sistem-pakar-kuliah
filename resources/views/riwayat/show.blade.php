<!-- resources/views/riwayat/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Detail Hasil Tes</h1>
                        <p class="text-indigo-100">Lihat rekomendasi jurusan berdasarkan hasil tes Anda</p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-chart-line text-5xl text-indigo-200"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test Info Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Informasi Tes</h2>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>{{ $riwayat->created_at->format('d F Y, H:i') }} WIB</span>
                    </div>
                </div>
                <div class="mt-4 md:mt-0">
                    @if(isset($riwayat->hasil['rekomendasi']) && is_array($riwayat->hasil['rekomendasi']) && !empty($riwayat->hasil['rekomendasi']))
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            <i class="fas fa-check-circle mr-2"></i>Tes Selesai
                        </span>
                    @else
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Tidak Ada Hasil
                        </span>
                    @endif
                </div>
            </div>

            <!-- Stats Overview -->
            @if(isset($riwayat->hasil['rekomendasi']) && is_array($riwayat->hasil['rekomendasi']) && !empty($riwayat->hasil['rekomendasi']))
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-indigo-50 rounded-lg p-4 text-center">
                        <i class="fas fa-graduation-cap text-indigo-600 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-600">Total Rekomendasi</p>
                        <p class="text-2xl font-bold text-indigo-600">{{ count($riwayat->hasil['rekomendasi']) }}</p>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4 text-center">
                        <i class="fas fa-trophy text-green-600 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-600">Skor Tertinggi</p>
                        <p class="text-2xl font-bold text-green-600">
                            @php
                                $topScore = collect($riwayat->hasil['rekomendasi'])->max('skor_akhir');
                            @endphp
                            {{ $topScore ?? 0 }}
                        </p>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-4 text-center">
                        <i class="fas fa-star text-purple-600 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-600">Jurusan Teratas</p>
                        <p class="text-lg font-bold text-purple-600">
                            @php
                                $topRecommendation = collect($riwayat->hasil['rekomendasi'])->sortByDesc('skor_akhir')->first();
                            @endphp
                            @if($topRecommendation && isset($topRecommendation['jurusan']))
                                @if(is_array($topRecommendation['jurusan']))
                                    {{ Str::limit($topRecommendation['jurusan']['nama_jurusan'] ?? '', 20) }}
                                @else
                                    {{ Str::limit($topRecommendation['jurusan']->nama_jurusan ?? '', 20) }}
                                @endif
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Recommendations Section -->
        @if(isset($riwayat->hasil['rekomendasi']) && is_array($riwayat->hasil['rekomendasi']) && !empty($riwayat->hasil['rekomendasi']))
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Rekomendasi Jurusan</h2>
                
                <div class="space-y-6">
                    @foreach($riwayat->hasil['rekomendasi'] as $index => $result)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden {{ $index === 0 ? 'ring-2 ring-indigo-500' : '' }}">
                            @if($index === 0)
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-trophy mr-2"></i>
                                        <span class="font-semibold">Rekomendasi Teratas</span>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-4">
                                    <div class="mb-4 md:mb-0">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                                            @if(is_array($result['jurusan']))
                                                {{ $result['jurusan']['nama_jurusan'] ?? 'Jurusan Tidak Diketahui' }}
                                            @else
                                                {{ $result['jurusan']->nama_jurusan ?? 'Jurusan Tidak Diketahui' }}
                                            @endif
                                        </h3>
                                        <div class="flex items-center">
                                            <span class="text-sm text-gray-500 mr-2">Skor Kecocokan:</span>
                                            <div class="flex items-center">
                                                <div class="w-32 bg-gray-200 rounded-full h-2.5 mr-2">
                                                    <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ min(100, ($result['skor_akhir'] ?? 0) * 20) }}%"></div>
                                                </div>
                                                <span class="text-lg font-semibold {{ $index === 0 ? 'text-indigo-600' : 'text-gray-700' }}">
                                                    {{ $result['skor_akhir'] ?? 0 }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div id="details-{{ $index }}" class="space-y-4">
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-info-circle mr-2 text-indigo-500"></i>
                                            Deskripsi
                                        </h4>
                                        <p class="text-gray-600">
                                            @if(is_array($result['jurusan']))
                                                {{ $result['jurusan']['deskripsi'] ?? 'Tidak ada deskripsi' }}
                                            @else
                                                {{ $result['jurusan']->deskripsi ?? 'Tidak ada deskripsi' }}
                                            @endif
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                                            Alasan Rekomendasi
                                        </h4>
                                        <p class="text-gray-600">{{ $result['alasan'] ?? 'Tidak ada alasan' }}</p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-briefcase mr-2 text-green-500"></i>
                                            Prospek Kerja
                                        </h4>
                                        <p class="text-gray-600">
                                            @if(is_array($result['jurusan']))
                                                {{ $result['jurusan']['prospek_kerja'] ?? 'Tidak ada informasi prospek kerja' }}
                                            @else
                                                {{ $result['jurusan']->prospek_kerja ?? 'Tidak ada informasi prospek kerja' }}
                                            @endif
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-university mr-2 text-purple-500"></i>
                                            Kampus Rekomendasi
                                        </h4>
                                        <div class="flex flex-wrap gap-2">
                                            @if(is_array($result['jurusan']))
                                                @php
                                                    $kampusList = json_decode($result['jurusan']['kampus_rekomendasi'] ?? '[]');
                                                @endphp
                                            @else
                                                @php
                                                    $kampusList = json_decode($result['jurusan']->kampus_rekomendasi ?? '[]');
                                                @endphp
                                            @endif
                                            
                                            @if(is_array($kampusList) && !empty($kampusList))
                                                @foreach($kampusList as $kampus)
                                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm rounded-full">{{ $kampus }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-gray-500 text-sm">Tidak ada informasi kampus</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                <div class="flex justify-center mb-4">
                    <div class="h-24 w-24 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl"></i>
                    </div>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada Hasil</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">
                    Hasil tes tidak tersedia atau tidak valid. Silakan coba melakukan tes kembali untuk mendapatkan rekomendasi jurusan.
                </p>
                <a href="{{ route('konsultasi.form') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 inline-flex items-center">
                    <i class="fas fa-redo mr-2"></i>
                    Uji Lagi
                </a>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-between items-center mt-8 space-y-4 sm:space-y-0">
            <a href="{{ route('riwayat.index') }}" class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Riwayat
            </a>
            
            <div class="flex space-x-4">
                <a href="{{ route('konsultasi.form') }}" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
                    Uji Lagi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection