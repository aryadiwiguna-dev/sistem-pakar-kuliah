@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Edit Pertanyaan</h1>

        <div class="bg-white shadow-xl rounded-2xl p-8">
            <form action="{{ route('admin.pertanyaan.update', $pertanyaan->id) }}" method="POST" x-data="editForm()">
                @csrf
                @method('PUT')
                
                <!-- Input Pertanyaan Utama -->
                <div class="mb-6">
                    <label for="pertanyaan" class="block text-sm font-semibold text-gray-700 mb-2">Teks Pertanyaan</label>
                    <input type="text" name="pertanyaan" id="pertanyaan" x-model="form.pertanyaan" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label for="jenis_pertanyaan" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Pertanyaan</label>
                    <select name="jenis_pertanyaan" id="jenis_pertanyaan" x-model="form.jenis_pertanyaan" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="pilihan_ganda">Pilihan Ganda</option>
                        <option value="skala">Skala (misal: Sangat Setuju - Sangat Tidak Setuju)</option>
                        <option value="input_angka">Input Angka</option>
                    </select>
                </div>

                <hr class="my-8">

                <!-- Input Opsi Jawaban Dinamis -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900">Opsi Jawaban</h3>
                    <p class="text-sm text-gray-600">Edit opsi jawaban dan tentukan jurusan yang cocok dengan jawaban tersebut.</p>

                    <template x-for="(jawaban, index) in form.jawabans" :key="index">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="font-medium text-gray-900">Opsi <span x-text="index + 1"></span></h4>
                                <button type="button" @click="removeJawaban(index)" class="text-red-600 hover:text-red-800 text-sm" x-show="form.jawabans.length > 2">
                                    Hapus Opsi
                                </button>
                            </div>
                            
                            <input type="hidden" :name="`jawabans[${index}][id]`" x-model="jawaban.id">
                            
                            <input type="text" :name="`jawabans[${index}][opsi_jawaban]`" x-model="jawaban.opsi_jawaban" class="block w-full mb-4 px-3 py-2 border border-gray-300 rounded-md" placeholder="Teks opsi jawaban" required>
                            
                            <!-- Pilih Jurusan -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan yang Cocok:</label>
                                <select :name="`jawabans[${index}][jurusan_id]`" x-model="jawaban.jurusan_id" class="block w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    <template x-for="jurusan in jurusans" :key="jurusan.id">
                                        <option :value="jurusan.id" x-text="jurusan.nama_jurusan" :selected="jawaban.jurusan_id == jurusan.id"></option>
                                    </template>
                                </select>
                            </div>
                            
                            <!-- Alasan Kesimpulan -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Kesimpulan:</label>
                                <textarea :name="`jawabans[${index}][conclusion_reason]`" x-model="jawaban.conclusion_reason" class="block w-full px-3 py-2 border border-gray-300 rounded-md" rows="2" placeholder="Alasan mengapa jawaban ini cocok untuk jurusan yang dipilih" required></textarea>
                            </div>
                            
                            <!-- Bobot -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bobot:</label>
                                <input type="number" :name="`jawabans[${index}][bobot]`" x-model="jawaban.bobot" class="block w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Bobot" min="1" max="5" required>
                            </div>
                        </div>
                    </template>
                </div>

                <button type="button" @click="addJawaban()" class="mt-4 w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-150">
                    + Tambah Opsi Jawaban
                </button>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.pertanyaan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg">Batal</a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">Update Pertanyaan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk Alpine.js -->
<script>
function editForm() {
    return {
        form: {
            pertanyaan: '',
            jenis_pertanyaan: 'pilihan_ganda',
            jawabans: []
        },
        jurusans: [],
        
        init() {
            // Inisialisasi data pertanyaan
            this.form.pertanyaan = `{{ $pertanyaan->pertanyaan ?? '' }}`;
            this.form.jenis_pertanyaan = `{{ $pertanyaan->jenis_pertanyaan ?? 'pilihan_ganda' }}`;
            
            // Inisialisasi data jurusan
            this.jurusans = @json($jurusans);
            
            // Inisialisasi jawabans dari data yang ada
            const jawabansData = @json($jawabansFormatted);
            
            if (jawabansData.length > 0) {
                this.form.jawabans = jawabansData;
            } else {
                // Jika tidak ada jawaban, buat 2 jawaban kosong
                this.form.jawabans = [
                    { id: null, opsi_jawaban: '', jurusan_id: '', conclusion_reason: '', bobot: 1 },
                    { id: null, opsi_jawaban: '', jurusan_id: '', conclusion_reason: '', bobot: 1 }
                ];
            }
            
            // Debug: Tampilkan data di console
            console.log('Form data:', this.form);
            console.log('Jurusans:', this.jurusans);
        },
        
        addJawaban() {
            this.form.jawabans.push({ id: null, opsi_jawaban: '', jurusan_id: '', conclusion_reason: '', bobot: 1 });
        },
        
        removeJawaban(index) {
            this.form.jawabans.splice(index, 1);
        }
    }
}
</script>
@endsection