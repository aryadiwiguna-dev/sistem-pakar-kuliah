@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manajemen Pertanyaan</h1>
                <p class="mt-1 text-sm text-gray-600">Kelola pertanyaan dan aturan penilaian untuk sistem rekomendasi jurusan.</p>
            </div>
            <a href="{{ route('admin.pertanyaan.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Pertanyaan
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-indigo-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                        <i class="fas fa-question-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Pertanyaan</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $pertanyaans->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-list-ul text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Opsi Jawaban</p>
                        <p class="text-2xl font-bold text-gray-800">
                            @php
                                $totalOptions = 0;
                                foreach($pertanyaans as $pertanyaan) {
                                    $totalOptions += $pertanyaan->jawabans_count;
                                }
                            @endphp
                            {{ $totalOptions }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <i class="fas fa-check-square text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pilihan Ganda</p>
                        <p class="text-2xl font-bold text-gray-800">
                            @php
                                $pilihanGanda = 0;
                                foreach($pertanyaans as $pertanyaan) {
                                    if($pertanyaan->jenis_pertanyaan === 'pilihan_ganda') {
                                        $pilihanGanda++;
                                    }
                                }
                            @endphp
                            {{ $pilihanGanda }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-sliders-h text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Skala</p>
                        <p class="text-2xl font-bold text-gray-800">
                            @php
                                $skala = 0;
                                foreach($pertanyaans as $pertanyaan) {
                                    if($pertanyaan->jenis_pertanyaan === 'skala') {
                                        $skala++;
                                    }
                                }
                            @endphp
                            {{ $skala }}
                        </p>
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
                        <input type="text" id="searchInput" placeholder="Cari pertanyaan..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
                <div class="flex gap-2">
                    <select id="filterType" class="block px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="all">Semua Jenis</option>
                        <option value="pilihan_ganda">Pilihan Ganda</option>
                        <option value="skala">Skala</option>
                        <option value="input_angka">Input Angka</option>
                    </select>
                    <select id="sortBy" class="block px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="most-options">Paling Banyak Opsi</option>
                        <option value="least-options">Paling Sedikit Opsi</option>
                    </select>
                    <button id="refreshBtn" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabel Pertanyaan -->
        <div class="bg-white overflow-hidden shadow-xl rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    Pertanyaan
                                    <button class="ml-1" onclick="sortTable('question')">
                                        <i class="fas fa-sort text-gray-400"></i>
                                    </button>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    Jenis
                                    <button class="ml-1" onclick="sortTable('type')">
                                        <i class="fas fa-sort text-gray-400"></i>
                                    </button>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    Opsi Jawaban
                                    <button class="ml-1" onclick="sortTable('options')">
                                        <i class="fas fa-sort text-gray-400"></i>
                                    </button>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="pertanyaanTableBody">
                        @forelse ($pertanyaans as $pertanyaan)
                            <tr class="hover:bg-gray-50 transition-colors" data-type="{{ $pertanyaan->jenis_pertanyaan }}" data-options="{{ $pertanyaan->jawabans_count }}" data-id="{{ $pertanyaan->id }}">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ Str::limit($pertanyaan->pertanyaan, 80) }}
                                    </div>
                                    @if(strlen($pertanyaan->pertanyaan) > 80)
                                        <button class="text-xs text-indigo-600 hover:text-indigo-800 mt-1" onclick="showFullText({{ $pertanyaan->id }}, '{{ $pertanyaan->pertanyaan }}')">
                                            Lihat selengkapnya
                                        </button>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($pertanyaan->jenis_pertanyaan)
                                        @case('pilihan_ganda')
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                <i class="fas fa-list-ul mr-1"></i>Pilihan Ganda
                                            </span>
                                            @break
                                        @case('skala')
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-sliders-h mr-1"></i>Skala
                                            </span>
                                            @break
                                        @case('input_angka')
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                <i class="fas fa-sort-numeric-up mr-1"></i>Input Angka
                                            </span>
                                            @break
                                        @default
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ $pertanyaan->jenis_pertanyaan }}
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm text-gray-900">{{ $pertanyaan->jawabans_count }} opsi</div>
                                        <div class="ml-2 w-16 bg-gray-200 rounded-full h-2">
                                            <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ min(100, ($pertanyaan->jawabans_count / 10) * 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($pertanyaan->jawabans_count >= 3)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                           Kurang Opsi
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.pertanyaan.edit', $pertanyaan->id) }}" class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete({{ $pertanyaan->id }}, '{{ Str::limit($pertanyaan->pertanyaan, 30) }}')" class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pertanyaan</h3>
                                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan pertanyaan baru.</p>
                                        <div class="mt-6">
                                            <a href="{{ route('admin.pertanyaan.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                                Tambah Pertanyaan Baru
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
            <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Pertanyaan</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Apakah Anda yakin ingin menghapus pertanyaan "<span id="questionName" class="font-semibold"></span>"? Tindakan ini juga akan menghapus semua aturan jawabannya dan tidak dapat dibatalkan.
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



<!-- Full Text Modal -->
<div id="fullTextModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Teks Lengkap Pertanyaan</h3>
            <button id="closeFullTextModal" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="fullTextContent">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>


<script>
// Delete confirmation
function confirmDelete(id, name) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    const nameSpan = document.getElementById('questionName');
    
    form.action = `/admin/pertanyaan/${id}`;
    nameSpan.textContent = name;
    modal.classList.remove('hidden');
}

// Cancel delete
document.getElementById('cancelDelete').addEventListener('click', function() {
    document.getElementById('deleteModal').classList.add('hidden');
});



// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#pertanyaanTableBody tr');
    
    rows.forEach(row => {
        const question = row.querySelector('td:first-child').textContent.toLowerCase();
        if (question.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Filter functionality
document.getElementById('filterType').addEventListener('change', function(e) {
    const filterType = e.target.value;
    const rows = document.querySelectorAll('#pertanyaanTableBody tr');
    
    rows.forEach(row => {
        if (filterType === 'all' || row.dataset.type === filterType) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Sort functionality
document.getElementById('sortBy').addEventListener('change', function(e) {
    const sortBy = e.target.value;
    const tbody = document.getElementById('pertanyaanTableBody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    rows.sort((a, b) => {
        switch(sortBy) {
            case 'newest':
                return b.dataset.id - a.dataset.id;
            case 'oldest':
                return a.dataset.id - b.dataset.id;
            case 'most-options':
                return b.dataset.options - a.dataset.options;
            case 'least-options':
                return a.dataset.options - b.dataset.options;
            default:
                return 0;
        }
    });
    
    // Re-append sorted rows
    rows.forEach(row => tbody.appendChild(row));
});

// Refresh button
document.getElementById('refreshBtn').addEventListener('click', function() {
    location.reload();
});


// Sort table by column
function sortTable(column) {
    // Implementation for column sorting
    showNotification('Fitur sorting akan segera tersedia', 'info');
}
</script>
@endsection