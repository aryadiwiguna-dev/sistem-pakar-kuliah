<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\Pertanyaan;
use App\Models\Jawaban;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ========================================
        // 1. BUAT DATA JURUSAN
        // ========================================

        $ti = Jurusan::create([
            'nama_jurusan' => 'Teknik Informatika',
            'deskripsi' => 'Mempelajari perbaikan, pengembangan, dan implementasi perangkat lunak serta sistem komputer. Fokus pada pemrograman, algoritma, basis data, jaringan komputer, dan kecerdasan buatan.',
            'prospek_kerja' => 'Software Engineer, Data Scientist, Full Stack Developer, UI/UX Designer, Cybersecurity Analyst, AI Engineer, Mobile App Developer, DevOps Engineer.',
            'kampus_rekomendasi' => json_encode(['UI', 'ITB', 'ITS', 'UGM', 'Binus University', 'Telkom University', 'Universitas Brawijaya'])
        ]);

        $akuntansi = Jurusan::create([
            'nama_jurusan' => 'Akuntansi',
            'deskripsi' => 'Mempelajari pencatatan, perencanaan, auditing, perpajakan, dan analisis keuangan sebuah entitas bisnis. Fokus pada laporan keuangan, audit, manajemen keuangan, dan sistem informasi akuntansi.',
            'prospek_kerja' => 'Akuntan Publik, Auditor Internal/Eksternal, Tax Consultant, Financial Analyst, Management Accountant, Finance Manager, Budget Analyst.',
            'kampus_rekomendasi' => json_encode(['UI', 'UGM', 'UB', 'Unpad', 'Binus University', 'Universitas Airlangga', 'Trisakti'])
        ]);

        $kedokteran = Jurusan::create([
            'nama_jurusan' => 'Kedokteran',
            'deskripsi' => 'Mempelajari ilmu tentang kesehatan, anatomi tubuh manusia, penyakit, diagnosis, dan cara pengobatan. Program ini mempersiapkan mahasiswa menjadi dokter profesional yang kompeten.',
            'prospek_kerja' => 'Dokter Umum, Dokter Spesialis, Peneliti Medis, Konsultan Kesehatan, Dosen Kedokteran, Medical Officer.',
            'kampus_rekomendasi' => json_encode(['UI', 'UGM', 'Unair', 'Unpad', 'UB', 'Undip', 'USU'])
        ]);

        $dkv = Jurusan::create([
            'nama_jurusan' => 'Desain Komunikasi Visual',
            'deskripsi' => 'Mempelajari seni dalam menyampaikan pesan atau informasi melalui media visual seperti desain grafis, ilustrasi, fotografi, videografi, dan animasi.',
            'prospek_kerja' => 'Graphic Designer, Art Director, Illustrator, Brand Strategist, Motion Graphic Designer, Creative Director, UI/UX Designer.',
            'kampus_rekomendasi' => json_encode(['Binus University', 'Trisakti', 'ITB', 'IKJ', 'ISI Yogyakarta', 'Telkom University', 'UPI'])
        ]);

        $psikologi = Jurusan::create([
            'nama_jurusan' => 'Psikologi',
            'deskripsi' => 'Mempelajari perilaku manusia, proses mental, dan interaksi sosial. Fokus pada psikologi klinis, industri organisasi, pendidikan, dan perkembangan.',
            'prospek_kerja' => 'Psikolog Klinis, HR Specialist, Konselor, Peneliti, Psikolog Pendidikan, Industrial Psychologist.',
            'kampus_rekomendasi' => json_encode(['UI', 'UGM', 'Unpad', 'Unair', 'UB', 'Binus University', 'Universitas Tarumanagara'])
        ]);

        $hukum = Jurusan::create([
            'nama_jurusan' => 'Ilmu Hukum',
            'deskripsi' => 'Mempelajari sistem hukum, peraturan perundang-undangan, dan penerapannya dalam masyarakat. Mencakup hukum pidana, perdata, tata negara, dan hukum internasional.',
            'prospek_kerja' => 'Advokat, Hakim, Jaksa, Notaris, Legal Consultant, Corporate Legal, Legal Drafter.',
            'kampus_rekomendasi' => json_encode(['UI', 'UGM', 'Unpad', 'UB', 'Undip', 'Unair', 'Universitas Trisakti'])
        ]);

        $manajemen = Jurusan::create([
            'nama_jurusan' => 'Manajemen',
            'deskripsi' => 'Mempelajari pengelolaan organisasi bisnis, meliputi perencanaan, pengorganisasian, kepemimpinan, dan pengendalian sumber daya untuk mencapai tujuan organisasi.',
            'prospek_kerja' => 'Manager, Business Analyst, Marketing Manager, Entrepreneur, Project Manager, Operations Manager, HR Manager.',
            'kampus_rekomendasi' => json_encode(['UI', 'UGM', 'ITB', 'Binus University', 'Prasetiya Mulya', 'Unpad', 'Universitas Airlangga'])
        ]);

        $teknikSipil = Jurusan::create([
            'nama_jurusan' => 'Teknik Sipil',
            'deskripsi' => 'Mempelajari perencanaan, desain, konstruksi, dan pemeliharaan infrastruktur seperti jalan, jembatan, gedung, bendungan, dan sistem transportasi.',
            'prospek_kerja' => 'Civil Engineer, Construction Manager, Structural Engineer, Project Engineer, Quantity Surveyor, Site Manager.',
            'kampus_rekomendasi' => json_encode(['ITB', 'UGM', 'ITS', 'UI', 'Undip', 'UB', 'Universitas Diponegoro'])
        ]);

        // ========================================
        // 2. BUAT DATA PERTANYAAN
        // ========================================

        // Pertanyaan 1: Minat Bidang
        $p1 = Pertanyaan::create([
            'pertanyaan' => 'Bidang mana yang paling menarik minat Anda untuk dipelajari di perguruan tinggi?',
            'jenis_pertanyaan' => 'pilihan_ganda'
        ]);

        // Pertanyaan 2: Kemampuan Numerik
        $p2 = Pertanyaan::create([
            'pertanyaan' => 'Bagaimana Anda menggambarkan kemampuan Anda dalam bekerja dengan angka dan data?',
            'jenis_pertanyaan' => 'pilihan_ganda'
        ]);

        // Pertanyaan 3: Peran dalam Tim
        $p3 = Pertanyaan::create([
            'pertanyaan' => 'Dalam sebuah tim, peran apa yang paling Anda sukai?',
            'jenis_pertanyaan' => 'pilihan_ganda'
        ]);

        // Pertanyaan 4: Lingkungan Belajar
        $p4 = Pertanyaan::create([
            'pertanyaan' => 'Di lingkungan mana Anda merasa dapat belajar dan berkembang paling baik?',
            'jenis_pertanyaan' => 'pilihan_ganda'
        ]);

        // Pertanyaan 5: Tujuan Karir
        $p5 = Pertanyaan::create([
            'pertanyaan' => 'Apa tujuan utama Anda dalam 5 hingga 10 tahun ke depan?',
            'jenis_pertanyaan' => 'pilihan_ganda'
        ]);

        // Pertanyaan 6: Aktivitas Favorit
        $p6 = Pertanyaan::create([
            'pertanyaan' => 'Aktivitas mana yang paling Anda nikmati di waktu luang?',
            'jenis_pertanyaan' => 'pilihan_ganda'
        ]);

        // Pertanyaan 7: Kemampuan Komunikasi
        $p7 = Pertanyaan::create([
            'pertanyaan' => 'Bagaimana Anda menggambarkan kemampuan komunikasi Anda?',
            'jenis_pertanyaan' => 'pilihan_ganda'
        ]);

        // Pertanyaan 8: Cara Menyelesaikan Masalah
        $p8 = Pertanyaan::create([
            'pertanyaan' => 'Ketika menghadapi masalah, pendekatan apa yang biasa Anda gunakan?',
            'jenis_pertanyaan' => 'pilihan_ganda'
        ]);

        // Pertanyaan 9: Mata Pelajaran Favorit
        $p9 = Pertanyaan::create([
            'pertanyaan' => 'Mata pelajaran apa yang paling Anda sukai saat sekolah?',
            'jenis_pertanyaan' => 'pilihan_ganda'
        ]);

        // Pertanyaan 10: Gaya Kerja
        $p10 = Pertanyaan::create([
            'pertanyaan' => 'Gaya kerja mana yang paling sesuai dengan kepribadian Anda?',
            'jenis_pertanyaan' => 'pilihan_ganda'
        ]);

        // ========================================
        // 3. BUAT DATA JAWABAN DENGAN BOBOT
        // ========================================

        // --- JAWABAN PERTANYAAN 1: Minat Bidang ---
        Jawaban::create([
            'pertanyaan_id' => $p1->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Sains dan Teknologi',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki minat yang kuat di bidang teknologi dan sains, cocok untuk Teknik Informatika.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p1->id,
            'jurusan_id' => $akuntansi->id,
            'opsi_jawaban' => 'Bisnis & Manajemen',
            'bobot' => 2,
            'conclusion_reason' => 'Anda tertarik di bidang bisnis dan pengelolaan keuangan.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p1->id,
            'jurusan_id' => $manajemen->id,
            'opsi_jawaban' => 'Bisnis & Manajemen',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki passion dalam dunia bisnis dan manajemen organisasi.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p1->id,
            'jurusan_id' => $kedokteran->id,
            'opsi_jawaban' => 'Kesehatan & Kesejahteraan',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki minat mendalam di bidang kesehatan dan ingin membantu orang lain.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p1->id,
            'jurusan_id' => $dkv->id,
            'opsi_jawaban' => 'Seni & Desain',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki jiwa seni dan kreativitas visual yang tinggi.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p1->id,
            'jurusan_id' => $psikologi->id,
            'opsi_jawaban' => 'Sosial & Humaniora',
            'bobot' => 3,
            'conclusion_reason' => 'Anda tertarik memahami perilaku manusia dan dinamika sosial.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p1->id,
            'jurusan_id' => $hukum->id,
            'opsi_jawaban' => 'Hukum & Politik',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki minat dalam sistem hukum dan keadilan.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p1->id,
            'jurusan_id' => $teknikSipil->id,
            'opsi_jawaban' => 'Teknik & Konstruksi',
            'bobot' => 3,
            'conclusion_reason' => 'Anda tertarik pada pembangunan infrastruktur dan konstruksi.'
        ]);

        // --- JAWABAN PERTANYAAN 2: Kemampuan Numerik ---
        // Opsi A: Untuk jurusan yang sangat membutuhkan kemampuan numerik tinggi
        Jawaban::create([
            'pertanyaan_id' => $p2->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Sangat Baik - Saya suka bekerja dengan angka dan data',
            'bobot' => 3,
            'conclusion_reason' => 'Kemampuan numerik Anda sangat mendukung untuk bidang teknologi informasi.'
        ]);
        Jawaban::create([
            'pertanyaan_id' => $p2->id,
            'jurusan_id' => $akuntansi->id,
            'opsi_jawaban' => 'Sangat Baik - Saya suka bekerja dengan angka dan data',
            'bobot' => 3,
            'conclusion_reason' => 'Kemampuan numerik yang kuat sangat penting dalam akuntansi.'
        ]);
        Jawaban::create([
            'pertanyaan_id' => $p2->id,
            'jurusan_id' => $teknikSipil->id,
            'opsi_jawaban' => 'Sangat Baik - Saya suka bekerja dengan angka dan data',
            'bobot' => 3,
            'conclusion_reason' => 'Teknik sipil membutuhkan kemampuan kalkulasi dan analisis yang kuat.'
        ]);

        // Opsi B: Untuk jurusan yang cukup memerlukan numerik
        Jawaban::create([
            'pertanyaan_id' => $p2->id,
            'jurusan_id' => $manajemen->id,
            'opsi_jawaban' => 'Baik - Saya cukup nyaman dengan angka',
            'bobot' => 2,
            'conclusion_reason' => 'Kemampuan numerik Anda cukup untuk analisis bisnis dan manajemen.'
        ]);
        Jawaban::create([
            'pertanyaan_id' => $p2->id,
            'jurusan_id' => $kedokteran->id,
            'opsi_jawaban' => 'Baik - Saya cukup nyaman dengan angka',
            'bobot' => 1,
            'conclusion_reason' => 'Kedokteran lebih fokus pada pemahaman biologis daripada numerik murni.'
        ]);
        Jawaban::create([
            'pertanyaan_id' => $p2->id,
            'jurusan_id' => $psikologi->id,
            'opsi_jawaban' => 'Baik - Saya cukup nyaman dengan angka',
            'bobot' => 2,
            'conclusion_reason' => 'Psikologi memerlukan pemahaman statistik untuk riset.'
        ]);

        // Opsi C: Untuk jurusan yang lebih kreatif/verbal
        Jawaban::create([
            'pertanyaan_id' => $p2->id,
            'jurusan_id' => $dkv->id,
            'opsi_jawaban' => 'Kurang Baik - Saya lebih suka hal-hal yang kreatif',
            'bobot' => 2,
            'conclusion_reason' => 'DKV lebih mengandalkan kreativitas visual daripada kemampuan numerik.'
        ]);
        Jawaban::create([
            'pertanyaan_id' => $p2->id,
            'jurusan_id' => $hukum->id,
            'opsi_jawaban' => 'Kurang Baik - Saya lebih suka hal-hal yang kreatif',
            'bobot' => 1,
            'conclusion_reason' => 'Hukum lebih menekankan pada logika dan argumentasi verbal.'
        ]);

        // --- JAWABAN PERTANYAAN 3: Peran dalam Tim ---
        Jawaban::create([
            'pertanyaan_id' => $p3->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Problem Solver - Mencari solusi teknis',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki tipe pribadi yang analitis dan suka memecahkan masalah.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p3->id,
            'jurusan_id' => $akuntansi->id,
            'opsi_jawaban' => 'Organizer - Mengatur dan mendokumentasi',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki sifat yang teliti, teratur, dan sistematis.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p3->id,
            'jurusan_id' => $kedokteran->id,
            'opsi_jawaban' => 'Supporter - Membantu dan mendukung anggota tim',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki empati tinggi dan suka menolong orang lain.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p3->id,
            'jurusan_id' => $dkv->id,
            'opsi_jawaban' => 'Creator - Membuat konten dan ide kreatif',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki jiwa kreatif dan inovatif dalam visual.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p3->id,
            'jurusan_id' => $manajemen->id,
            'opsi_jawaban' => 'Leader - Memimpin dan mengkoordinasi tim',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki kemampuan kepemimpinan dan koordinasi yang baik.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p3->id,
            'jurusan_id' => $psikologi->id,
            'opsi_jawaban' => 'Mediator - Menjembatani konflik dan memahami perspektif berbeda',
            'bobot' => 3,
            'conclusion_reason' => 'Anda pandai memahami dinamika interpersonal dan emosi orang lain.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p3->id,
            'jurusan_id' => $hukum->id,
            'opsi_jawaban' => 'Analyzer - Menganalisis dan memberikan argumen',
            'bobot' => 3,
            'conclusion_reason' => 'Anda kritis dan mampu menganalisis situasi dengan objektif.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p3->id,
            'jurusan_id' => $teknikSipil->id,
            'opsi_jawaban' => 'Planner - Merencanakan strategi dan eksekusi',
            'bobot' => 3,
            'conclusion_reason' => 'Anda sistematis dan terstruktur dalam perencanaan proyek.'
        ]);

        // --- JAWABAN PERTANYAAN 4: Lingkungan Belajar ---
        Jawaban::create([
            'pertanyaan_id' => $p4->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Laboratorium dan Praktikum langsung',
            'bobot' => 3,
            'conclusion_reason' => 'Anda adalah orang yang pragmatis dan hands-on dalam belajar teknologi.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p4->id,
            'jurusan_id' => $teknikSipil->id,
            'opsi_jawaban' => 'Laboratorium dan Praktikum langsung',
            'bobot' => 3,
            'conclusion_reason' => 'Anda suka belajar melalui praktek dan eksperimen langsung.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p4->id,
            'jurusan_id' => $akuntansi->id,
            'opsi_jawaban' => 'Kelas dan kuliah teori',
            'bobot' => 2,
            'conclusion_reason' => 'Anda lebih suka konsep dan teori yang mendalam dan sistematis.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p4->id,
            'jurusan_id' => $hukum->id,
            'opsi_jawaban' => 'Kelas dan kuliah teori',
            'bobot' => 3,
            'conclusion_reason' => 'Anda cocok dengan pembelajaran berbasis teori dan konsep hukum.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p4->id,
            'jurusan_id' => $dkv->id,
            'opsi_jawaban' => 'Studio dan workshop kreatif',
            'bobot' => 3,
            'conclusion_reason' => 'Anda berkembang dalam lingkungan yang mendorong eksplorasi kreatif.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p4->id,
            'jurusan_id' => $psikologi->id,
            'opsi_jawaban' => 'Diskusi dan kerja kelompok',
            'bobot' => 3,
            'conclusion_reason' => 'Anda suka berbagi ide dan bekerja sama dalam memahami manusia.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p4->id,
            'jurusan_id' => $manajemen->id,
            'opsi_jawaban' => 'Diskusi dan kerja kelompok',
            'bobot' => 2,
            'conclusion_reason' => 'Anda cocok dengan pembelajaran kolaboratif dan studi kasus.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p4->id,
            'jurusan_id' => $kedokteran->id,
            'opsi_jawaban' => 'Praktikum klinis dan interaksi langsung',
            'bobot' => 3,
            'conclusion_reason' => 'Anda belajar terbaik melalui pengalaman klinis langsung dengan pasien.'
        ]);

        // --- JAWABAN PERTANYAAN 5: Tujuan Karir ---
        Jawaban::create([
            'pertanyaan_id' => $p5->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Mendapatkan pekerjaan yang stabil dan mapan',
            'bobot' => 2,
            'conclusion_reason' => 'Anda mencari kestabilisan karir di industri teknologi yang terus berkembang.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p5->id,
            'jurusan_id' => $akuntansi->id,
            'opsi_jawaban' => 'Mendapatkan pekerjaan yang stabil dan mapan',
            'bobot' => 3,
            'conclusion_reason' => 'Akuntansi menawarkan jalur karir yang jelas dan stabil.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p5->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Melanjutkan studi ke jenjang yang lebih tinggi (S2/S3)',
            'bobot' => 2,
            'conclusion_reason' => 'Anda memiliki ambisi untuk terus mengembangkan kemampuan akademis.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p5->id,
            'jurusan_id' => $kedokteran->id,
            'opsi_jawaban' => 'Melanjutkan studi ke jenjang yang lebih tinggi (S2/S3)',
            'bobot' => 3,
            'conclusion_reason' => 'Kedokteran memerlukan spesialisasi lanjutan untuk karir profesional.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p5->id,
            'jurusan_id' => $psikologi->id,
            'opsi_jawaban' => 'Kontribusi positif bagi masyarakat',
            'bobot' => 3,
            'conclusion_reason' => 'Anda ingin pekerjaan yang memberikan dampak sosial dan membantu orang.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p5->id,
            'jurusan_id' => $manajemen->id,
            'opsi_jawaban' => 'Membangun bisnis atau startup sendiri',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki jiwa wirausaha dan ingin menjadi entrepreneur.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p5->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Membangun bisnis atau startup sendiri',
            'bobot' => 2,
            'conclusion_reason' => 'Teknologi informatika membuka peluang besar untuk membangun startup tech.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p5->id,
            'jurusan_id' => $dkv->id,
            'opsi_jawaban' => 'Berkarir di industri kreatif dan mengembangkan portfolio',
            'bobot' => 3,
            'conclusion_reason' => 'Anda ingin mengekspresikan kreativitas melalui karya profesional.'
        ]);

        // --- JAWABAN PERTANYAAN 6: Aktivitas Favorit ---
        Jawaban::create([
            'pertanyaan_id' => $p6->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Bermain game, coding, atau eksplorasi teknologi',
            'bobot' => 3,
            'conclusion_reason' => 'Hobi Anda menunjukkan passion di dunia teknologi digital.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p6->id,
            'jurusan_id' => $dkv->id,
            'opsi_jawaban' => 'Menggambar, desain, atau fotografi',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki bakat dan minat kuat dalam seni visual.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p6->id,
            'jurusan_id' => $psikologi->id,
            'opsi_jawaban' => 'Membaca buku self-help atau berdiskusi tentang perilaku manusia',
            'bobot' => 3,
            'conclusion_reason' => 'Anda tertarik memahami psikologi dan dinamika manusia.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p6->id,
            'jurusan_id' => $kedokteran->id,
            'opsi_jawaban' => 'Volunteering atau kegiatan sosial membantu orang',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki empati tinggi dan ingin berkontribusi untuk kesehatan masyarakat.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p6->id,
            'jurusan_id' => $manajemen->id,
            'opsi_jawaban' => 'Mengorganisir acara atau memimpin komunitas',
            'bobot' => 3,
            'conclusion_reason' => 'Anda senang mengatur dan memimpin dalam berbagai kegiatan.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p6->id,
            'jurusan_id' => $akuntansi->id,
            'opsi_jawaban' => 'Mengatur keuangan atau investasi pribadi',
            'bobot' => 3,
            'conclusion_reason' => 'Anda teliti dalam mengelola angka dan tertarik pada finansial.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p6->id,
            'jurusan_id' => $hukum->id,
            'opsi_jawaban' => 'Debat, menulis, atau membaca berita',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki kemampuan argumentasi dan analisis yang kuat.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p6->id,
            'jurusan_id' => $teknikSipil->id,
            'opsi_jawaban' => 'Membangun atau merancang sesuatu (DIY projects)',
            'bobot' => 3,
            'conclusion_reason' => 'Anda suka merancang dan membangun struktur fisik.'
        ]);

        // --- JAWABAN PERTANYAAN 7: Kemampuan Komunikasi ---
        Jawaban::create([
            'pertanyaan_id' => $p7->id,
            'jurusan_id' => $hukum->id,
            'opsi_jawaban' => 'Sangat Baik - Saya bisa berbicara dan berargumen dengan baik',
            'bobot' => 3,
            'conclusion_reason' => 'Kemampuan komunikasi verbal yang kuat penting dalam praktik hukum.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p7->id,
            'jurusan_id' => $manajemen->id,
            'opsi_jawaban' => 'Sangat Baik - Saya bisa berbicara dan berargumen dengan baik',
            'bobot' => 3,
            'conclusion_reason' => 'Manajemen memerlukan komunikasi efektif untuk kepemimpinan.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p7->id,
            'jurusan_id' => $psikologi->id,
            'opsi_jawaban' => 'Baik - Saya bisa mendengarkan dan memahami orang lain',
            'bobot' => 3,
            'conclusion_reason' => 'Kemampuan mendengarkan aktif sangat penting dalam psikologi.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p7->id,
            'jurusan_id' => $kedokteran->id,
            'opsi_jawaban' => 'Baik - Saya bisa mendengarkan dan memahami orang lain',
            'bobot' => 2,
            'conclusion_reason' => 'Dokter perlu komunikasi empatik dengan pasien.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p7->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Cukup - Saya lebih suka komunikasi tertulis atau digital',
            'bobot' => 2,
            'conclusion_reason' => 'IT profesional sering berkomunikasi melalui dokumentasi dan tools digital.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p7->id,
            'jurusan_id' => $dkv->id,
            'opsi_jawaban' => 'Visual - Saya lebih suka menyampaikan ide melalui gambar',
            'bobot' => 3,
            'conclusion_reason' => 'Anda berkomunikasi paling efektif melalui medium visual.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p7->id,
            'jurusan_id' => $akuntansi->id,
            'opsi_jawaban' => 'Cukup - Saya lebih suka komunikasi tertulis atau digital',
            'bobot' => 2,
            'conclusion_reason' => 'Akuntan berkomunikasi banyak melalui laporan dan dokumen tertulis.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p7->id,
            'jurusan_id' => $teknikSipil->id,
            'opsi_jawaban' => 'Teknis - Saya bisa menjelaskan konsep teknis dengan jelas',
            'bobot' => 3,
            'conclusion_reason' => 'Engineer perlu mengkomunikasikan konsep teknis ke berbagai pihak.'
        ]);

        // --- JAWABAN PERTANYAAN 8: Cara Menyelesaikan Masalah ---
        Jawaban::create([
            'pertanyaan_id' => $p8->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Analitis - Menganalisis data dan mencari pola',
            'bobot' => 3,
            'conclusion_reason' => 'Anda memiliki pendekatan sistematis dalam problem solving.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p8->id,
            'jurusan_id' => $akuntansi->id,
            'opsi_jawaban' => 'Metodis - Mengikuti prosedur dan aturan yang ada',
            'bobot' => 3,
            'conclusion_reason' => 'Anda terstruktur dan mengikuti standar dalam bekerja.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p8->id,
            'jurusan_id' => $dkv->id,
            'opsi_jawaban' => 'Kreatif - Mencari solusi unik dan out-of-the-box',
            'bobot' => 3,
            'conclusion_reason' => 'Anda berpikir kreatif dan inovatif dalam memecahkan masalah.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p8->id,
            'jurusan_id' => $psikologi->id,
            'opsi_jawaban' => 'Empatik - Mempertimbangkan aspek manusia dan emosi',
            'bobot' => 3,
            'conclusion_reason' => 'Anda sensitif terhadap faktor emosional dan interpersonal.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p8->id,
            'jurusan_id' => $hukum->id,
            'opsi_jawaban' => 'Logis - Menggunakan argumen dan bukti yang kuat',
            'bobot' => 3,
            'conclusion_reason' => 'Anda berpikir kritis dan berbasis pada logika hukum.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p8->id,
            'jurusan_id' => $manajemen->id,
            'opsi_jawaban' => 'Strategis - Melihat gambaran besar dan membuat rencana',
            'bobot' => 3,
            'conclusion_reason' => 'Anda pandai merencanakan strategi jangka panjang.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p8->id,
            'jurusan_id' => $kedokteran->id,
            'opsi_jawaban' => 'Diagnosa - Mengidentifikasi akar masalah secara sistematis',
            'bobot' => 3,
            'conclusion_reason' => 'Anda teliti dalam mencari penyebab masalah kesehatan.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p8->id,
            'jurusan_id' => $teknikSipil->id,
            'opsi_jawaban' => 'Praktis - Mencari solusi yang efisien dan aplikatif',
            'bobot' => 3,
            'conclusion_reason' => 'Anda fokus pada solusi yang dapat diimplementasikan secara nyata.'
        ]);

        // --- JAWABAN PERTANYAAN 9: Mata Pelajaran Favorit ---
        Jawaban::create([
            'pertanyaan_id' => $p9->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Matematika dan Fisika',
            'bobot' => 3,
            'conclusion_reason' => 'Fondasi matematika Anda kuat untuk pemrograman dan algoritma.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p9->id,
            'jurusan_id' => $teknikSipil->id,
            'opsi_jawaban' => 'Matematika dan Fisika',
            'bobot' => 3,
            'conclusion_reason' => 'Kemampuan matematika dan fisika penting untuk teknik sipil.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p9->id,
            'jurusan_id' => $akuntansi->id,
            'opsi_jawaban' => 'Ekonomi dan Matematika',
            'bobot' => 3,
            'conclusion_reason' => 'Pemahaman ekonomi dan angka Anda cocok untuk akuntansi.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p9->id,
            'jurusan_id' => $manajemen->id,
            'opsi_jawaban' => 'Ekonomi dan Matematika',
            'bobot' => 2,
            'conclusion_reason' => 'Dasar ekonomi dan bisnis Anda kuat untuk manajemen.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p9->id,
            'jurusan_id' => $kedokteran->id,
            'opsi_jawaban' => 'Biologi dan Kimia',
            'bobot' => 3,
            'conclusion_reason' => 'Minat sains kesehatan Anda sesuai untuk kedokteran.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p9->id,
            'jurusan_id' => $dkv->id,
            'opsi_jawaban' => 'Seni Budaya dan Bahasa',
            'bobot' => 3,
            'conclusion_reason' => 'Bakat seni dan kreativitas Anda sangat mendukung DKV.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p9->id,
            'jurusan_id' => $hukum->id,
            'opsi_jawaban' => 'Sejarah dan PKn',
            'bobot' => 3,
            'conclusion_reason' => 'Pemahaman sosial dan politik Anda cocok untuk ilmu hukum.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p9->id,
            'jurusan_id' => $psikologi->id,
            'opsi_jawaban' => 'Sosiologi dan Bahasa',
            'bobot' => 3,
            'conclusion_reason' => 'Minat Anda pada perilaku sosial sesuai dengan psikologi.'
        ]);

        // --- JAWABAN PERTANYAAN 10: Gaya Kerja ---
        Jawaban::create([
            'pertanyaan_id' => $p10->id,
            'jurusan_id' => $ti->id,
            'opsi_jawaban' => 'Mandiri - Saya lebih produktif bekerja sendiri',
            'bobot' => 3,
            'conclusion_reason' => 'Programmer sering bekerja mandiri dalam mengembangkan solusi.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p10->id,
            'jurusan_id' => $akuntansi->id,
            'opsi_jawaban' => 'Detail-oriented - Saya sangat teliti dan fokus pada detail',
            'bobot' => 3,
            'conclusion_reason' => 'Ketelitian sangat krusial dalam pekerjaan akuntansi.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p10->id,
            'jurusan_id' => $manajemen->id,
            'opsi_jawaban' => 'Kolaboratif - Saya suka bekerja dalam tim',
            'bobot' => 3,
            'conclusion_reason' => 'Manajer harus bisa bekerja dengan berbagai tim dan stakeholder.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p10->id,
            'jurusan_id' => $psikologi->id,
            'opsi_jawaban' => 'Kolaboratif - Saya suka bekerja dalam tim',
            'bobot' => 2,
            'conclusion_reason' => 'Psikolog bekerja dengan klien dan tim multidisiplin.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p10->id,
            'jurusan_id' => $dkv->id,
            'opsi_jawaban' => 'Fleksibel - Saya suka variasi dan tidak monoton',
            'bobot' => 3,
            'conclusion_reason' => 'Desainer menghadapi berbagai proyek dengan kebutuhan berbeda.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p10->id,
            'jurusan_id' => $kedokteran->id,
            'opsi_jawaban' => 'Dinamis - Saya siap menghadapi situasi yang berubah cepat',
            'bobot' => 3,
            'conclusion_reason' => 'Dunia medis memerlukan respons cepat terhadap kondisi darurat.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p10->id,
            'jurusan_id' => $hukum->id,
            'opsi_jawaban' => 'Penelitian - Saya suka menggali informasi mendalam',
            'bobot' => 3,
            'conclusion_reason' => 'Praktisi hukum perlu riset mendalam untuk kasus dan peraturan.'
        ]);

        Jawaban::create([
            'pertanyaan_id' => $p10->id,
            'jurusan_id' => $teknikSipil->id,
            'opsi_jawaban' => 'Terstruktur - Saya suka mengikuti timeline dan SOP',
            'bobot' => 3,
            'conclusion_reason' => 'Proyek konstruksi memerlukan perencanaan dan jadwal yang ketat.'
        ]);

    }
}
