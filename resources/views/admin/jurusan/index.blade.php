@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manajemen Jurusan</h1>
                <p class="mt-1 text-sm text-gray-600">Kelola data jurusan yang tersedia di sistem.</p>
            </div>
            <a href="{{ route('admin.jurusan.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Jurusan
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-indigo-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                        <i class="fas fa-graduation-cap text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Jurusan</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $jurusans->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-university text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Kampus</p>
                        <p class="text-2xl font-bold text-gray-800">
                            @php
                                $totalKampus = 0;
                                foreach($jurusans as $jurusan) {
                                    $kampusList = json_decode($jurusan->kampus_rekomendasi ?? '[]');
                                    $totalKampus += count($kampusList);
                                }
                            @endphp
                            {{ $totalKampus }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-briefcase text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jurusan Aktif</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $jurusans->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="searchInput" placeholder="Cari jurusan..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
                <div class="flex gap-2">
                    <select id="sortSelect" class="block px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="name">Urutkan Nama</option>
                        <option value="name-desc">Nama (Z-A)</option>
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                    </select>
                    <button id="filterBtn" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Grid Kartu Jurusan -->
        <div id="jurusanContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($jurusans as $jurusan)
                <div class="jurusan-card bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200 transition-all duration-300 hover:shadow-xl hover:scale-105" data-jurusan-id="{{ $jurusan->id }}">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">
                                    {{ $jurusan->nama_jurusan }}
                                </h3>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <span class="text-indigo-600 font-bold text-lg">{{ substr($jurusan->nama_jurusan, 0, 1) }}</span>
                                </div>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            {{ Str::limit($jurusan->deskripsi, 150) }}
                        </p>

                        <div class="mb-4">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Prospek Kerja</p>
                            <p class="text-sm text-gray-700">
                                {{ Str::limit($jurusan->prospek_kerja, 100) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kampus Rekomendasi</p>
                            <div class="flex flex-wrap gap-1">
                                @php
                                    $kampusList = json_decode($jurusan->kampus_rekomendasi ?? '[]');
                                    $displayCount = min(3, count($kampusList));
                                @endphp
                                @for($i = 0; $i < $displayCount; $i++)
                                    <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">{{ $kampusList[$i] }}</span>
                                @endfor
                                @if(count($kampusList) > 3)
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">+{{ count($kampusList) - 3 }} lagi</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Footer dengan Tombol Aksi -->
                    <div class="bg-gray-50 px-6 py-3 flex justify-between">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.jurusan.edit', $jurusan->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-medium rounded-md transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            
                            <button onclick="viewDetails({{ $jurusan->id }})" class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-md transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Detail
                            </button>
                        </div>
                        
                        <button onclick="confirmDelete({{ $jurusan->id }}, '{{ $jurusan->nama_jurusan }}')" class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium rounded-md transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada jurusan</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan jurusan baru.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.jurusan.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Jurusan Baru
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Jurusan</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menghapus jurusan "<span id="jurusanName" class="font-semibold"></span>"? Tindakan ini tidak dapat dibatalkan.
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

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Detail Jurusan</h3>
            <button id="closeDetailModal" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="detailContent">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<

<script>
// Delete confirmation
function confirmDelete(id, name) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    const nameSpan = document.getElementById('jurusanName');
    
    form.action = `/admin/jurusan/${id}`;
    nameSpan.textContent = name;
    modal.classList.remove('hidden');
}

// Cancel delete
document.getElementById('cancelDelete').addEventListener('click', function() {
    document.getElementById('deleteModal').classList.add('hidden');
});

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    const deleteModal = document.getElementById('deleteModal');
    const detailModal = document.getElementById('detailModal');
    
    if (event.target == deleteModal) {
        deleteModal.classList.add('hidden');
    }
    
    if (event.target == detailModal) {
        detailModal.classList.add('hidden');
    }
});

// View details
function viewDetails(id) {
    // In a real implementation, you would fetch the details via AJAX
    // For now, we'll just show a placeholder
    const modal = document.getElementById('detailModal');
    const content = document.getElementById('detailContent');
    
    // Find the jurusan card
    const card = document.querySelector(`[data-jurusan-id="${id}"]`);
    if (card) {
        // Clone the card content for the modal
        const cardContent = card.querySelector('.p-6').cloneNode(true);
        content.innerHTML = '';
        content.appendChild(cardContent);
        
        // Show the modal
        modal.classList.remove('hidden');
    }
}

// Close detail modal
document.getElementById('closeDetailModal').addEventListener('click', function() {
    document.getElementById('detailModal').classList.add('hidden');
});


// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const cards = document.querySelectorAll('.jurusan-card');
    
    cards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const description = card.querySelector('.text-gray-600').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});

// Sort functionality
document.getElementById('sortSelect').addEventListener('change', function(e) {
    const sortBy = e.target.value;
    const container = document.getElementById('jurusanContainer');
    const cards = Array.from(container.querySelectorAll('.jurusan-card'));
    
    cards.sort((a, b) => {
        const aTitle = a.querySelector('h3').textContent;
        const bTitle = b.querySelector('h3').textContent;
        
        switch(sortBy) {
            case 'name':
                return aTitle.localeCompare(bTitle);
            case 'name-desc':
                return bTitle.localeCompare(aTitle);
            case 'newest':
                return b.dataset.jurusanId - a.dataset.jurusanId;
            case 'oldest':
                return a.dataset.jurusanId - b.dataset.jurusanId;
            default:
                return 0;
        }
    });
    
    // Re-append sorted cards
    cards.forEach(card => container.appendChild(card));
});

// Filter button (placeholder)
document.getElementById('filterBtn').addEventListener('click', function() {
    showNotification('Fitur filter akan segera tersedia', 'info');
});
</script>
@endsection