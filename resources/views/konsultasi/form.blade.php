@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-100">
    <div class="max-w-2xl w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Temukan Jurusan Kuliah Anda</h2>
            <p class="mt-2 text-center text-sm text-gray-600">Jawab beberapa pertanyaan berikut untuk melihat rekomendasi jurusan yang paling sesuai.</p>
        </div>
        
        @if(isset($pertanyaans) && count($pertanyaans) > 0)
            <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow-lg" action="{{ route('konsultasi.process') }}" method="POST">
                @csrf
                
                @forelse ($pertanyaans as $index => $pertanyaan)
                    <div class="space-y-2">
                        <h3 class="text-lg font-medium text-gray-900">{{ $index + 1 }}. {{ $pertanyaan->pertanyaan }}</h3>
                        <div class="space-y-2">
                            {{-- Ambil opsi_jawaban yang UNIQUE saja --}}
                            @foreach ($pertanyaan->jawabans->unique('opsi_jawaban') as $jawaban)
                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                    <input class="form-radio h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" 
                                           type="radio" 
                                           name="jawaban[{{ $pertanyaan->id }}]" 
                                           value="{{ $jawaban->opsi_jawaban }}" 
                                           required>
                                    <span class="ml-3 text-gray-700">{{ $jawaban->opsi_jawaban }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    
                    @if (!$loop->last)
                        <hr class="my-6 border-gray-200">
                    @endif
                @empty
                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-md" role="alert">
                        <strong class="font-bold">Perhatian!</strong>
                        <span class="block sm:inline">Maaf, belum ada pertanyaan yang tersedia. Silakan hubungi administrator.</span>
                    </div>
                @endforelse

                <div class="pt-4">
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Lihat Rekomendasi
                    </button>
                </div>
            </form>
        @else
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-md" role="alert">
                <strong class="font-bold">Perhatian!</strong>
                <span class="block sm:inline">Maaf, belum ada pertanyaan yang tersedia. Silakan hubungi administrator atau coba lagi nanti.</span>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</div>
@endsection