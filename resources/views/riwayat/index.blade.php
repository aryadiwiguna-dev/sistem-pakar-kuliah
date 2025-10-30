<!-- resources/views/riwayat/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Riwayat Konsultasi</h1>
                        <p class="text-indigo-100">Lihat hasil tes jurusan yang telah Anda kerjakan</p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-history text-5xl text-indigo-200"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-indigo-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                        <i class="fas fa-clipboard-list text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Tes</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $riwayats->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-graduation-cap text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jurusan Direkomendasikan</p>
                        <p class="text-2xl font-bold text-gray-800">
                            @php
                                $totalRecommendations = 0;
                                foreach($riwayats as $riwayat) {
                                    if(isset($riwayat->hasil['rekomendasi']) && is_array($riwayat->hasil['rekomendasi'])) {
                                        $totalRecommendations += count($riwayat->hasil['rekomendasi']);
                                    }
                                }
                            @endphp
                            {{ $totalRecommendations }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-calendar-alt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tes Terakhir</p>
                        <p class="text-lg font-bold text-gray-800">
                            @if($riwayats->count() > 0)
                                {{ $riwayats->first()->created_at->format('d M Y') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Hasil Tes</h2>
            <a href="{{ route('konsultasi.form') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tes Baru
            </a>
        </div>

        <!-- Results Table -->
        @if($riwayats->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal & Waktu
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Hasil
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($riwayats as $riwayat)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600">
                                                <i class="fas fa-calendar-day"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $riwayat->created_at->format('d M Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $riwayat->created_at->format('H:i') }} WIB
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if(isset($riwayat->hasil['rekomendasi']) && is_array($riwayat->hasil['rekomendasi']))
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-green-100 text-green-600">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ count($riwayat->hasil['rekomendasi']) }} Jurusan Direkomendasikan
                                                    </div>
                                                    @if(!empty($riwayat->hasil['rekomendasi']))
                                                        @php
                                                            $topRecommendation = collect($riwayat->hasil['rekomendasi'])->sortByDesc('skor_akhir')->first();
                                                        @endphp
                                                        @if($topRecommendation && isset($topRecommendation['jurusan']))
                                                            <div class="text-sm text-gray-500">
                                                                Teratas: 
                                                                @if(is_array($topRecommendation['jurusan']))
                                                                    {{ $topRecommendation['jurusan']['nama_jurusan'] ?? 'Tidak diketahui' }}
                                                                @else
                                                                    {{ $topRecommendation['jurusan']->nama_jurusan ?? 'Tidak diketahui' }}
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-600">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        Tidak ada hasil
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        Terjadi kesalahan saat memproses tes
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(isset($riwayat->hasil['rekomendasi']) && is_array($riwayat->hasil['rekomendasi']))
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('riwayat.show', $riwayat->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <button class="text-red-600 hover:text-red-900" onclick="confirmDelete({{ $riwayat->id }})">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $riwayats->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow overflow-hidden p-12 text-center">
                <div class="flex justify-center mb-4">
                    <div class="h-24 w-24 rounded-full bg-gray-100 flex items-center justify-center">
                        <i class="fas fa-clipboard-list text-gray-400 text-4xl"></i>
                    </div>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Riwayat Tes</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">
                    Anda belum pernah melakukan tes jurusan. Mulai tes sekarang untuk mendapatkan rekomendasi jurusan yang sesuai dengan minat dan bakat Anda.
                </p>
                <a href="{{ route('konsultasi.form') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 inline-flex items-center">
                    <i class="fas fa-play mr-2"></i>
                    Mulai Tes Sekarang
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Riwayat Tes</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menghapus riwayat tes ini? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <form id="deleteForm" method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <button id="cancelDelete" type="button" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 mr-2">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    form.action = `/riwayat/${id}`;
    modal.classList.remove('hidden');
}

document.getElementById('cancelDelete').addEventListener('click', function() {
    document.getElementById('deleteModal').classList.add('hidden');
});

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    const modal = document.getElementById('deleteModal');
    if (event.target == modal) {
        modal.classList.add('hidden');
    }
});
</script>
@endsection