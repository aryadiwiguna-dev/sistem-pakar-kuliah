<!-- resources/views/landing.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temukan Jurusan Kuliah Impian Anda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .testimonial-card {
            transition: all 0.3s ease;
        }
        .testimonial-card:hover {
            transform: translateY(-5px);
        }
        .stat-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .stat-card-2 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .stat-card-3 {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-graduation-cap text-indigo-600 text-2xl mr-2"></i>
                        <span class="font-bold text-xl text-gray-800">JurusanKu</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#features" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Fitur</a>
                    <a href="#majors" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Jurusan</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Testimoni</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">Daftar</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Temukan Jurusan Kuliah Impian Anda</h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">Bingung memilih jurusan? Kami membantu Anda menemukan jurusan yang sesuai dengan minat, bakat, dan potensi Anda melalui tes psikologi terpercaya.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('konsultasi.form') }}" class="bg-white text-indigo-600 hover:bg-gray-100 font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
                        <i class="fas fa-play-circle mr-2"></i>Mulai Tes Sekarang
                    </a>
                    <a href="#features" class="border-2 border-white text-white hover:bg-white hover:text-indigo-600 font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="stat-card text-white rounded-lg p-8 text-center card-hover">
                    <i class="fas fa-graduation-cap text-4xl mb-4"></i>
                    <h3 class="text-3xl font-bold">{{ $stats['totalMajors'] }}+</h3>
                    <p class="text-lg">Pilihan Jurusan</p>
                </div>
                <div class="stat-card-2 text-white rounded-lg p-8 text-center card-hover">
                    <i class="fas fa-users text-4xl mb-4"></i>
                    <h3 class="text-3xl font-bold">{{ $stats['totalUsers'] }}+</h3>
                    <p class="text-lg">Pengguna Aktif</p>
                </div>
                <div class="stat-card-3 text-white rounded-lg p-8 text-center card-hover">
                    <i class="fas fa-clipboard-check text-4xl mb-4"></i>
                    <h3 class="text-3xl font-bold">{{ $stats['totalTests'] }}+</h3>
                    <p class="text-lg">Tes Telah Diselesaikan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Mengapa Memilih JurusanKu?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Kami menyediakan solusi lengkap untuk membantu Anda menemukan jurusan kuliah yang tepat</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg p-8 shadow-lg card-hover">
                    <div class="text-indigo-600 mb-4">
                        <i class="fas fa-brain text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Tes Psikologi Terpercaya</h3>
                    <p class="text-gray-600">Tes yang kami sediakan telah dikembangkan oleh psikolog profesional dan telah divalidasi untuk akurasi tinggi.</p>
                </div>
                
                <div class="bg-white rounded-lg p-8 shadow-lg card-hover">
                    <div class="text-indigo-600 mb-4">
                        <i class="fas fa-chart-line text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Hasil Analisis Mendalam</h3>
                    <p class="text-gray-600">Dapatkan laporan lengkap tentang kepribadian, minat, dan jurusan yang paling cocok untuk Anda.</p>
                </div>
                
                <div class="bg-white rounded-lg p-8 shadow-lg card-hover">
                    <div class="text-indigo-600 mb-4">
                        <i class="fas fa-university text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Info Jurusan Lengkap</h3>
                    <p class="text-gray-600">Dapatkan informasi detail tentang kurikulum, prospek karir, dan universitas terbaik untuk setiap jurusan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Majors Section -->
    <section id="majors" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Jurusan Populer</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Pelajari berbagai jurusan kuliah yang mungkin cocok untuk Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredMajors as $major)
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg card-hover">
                    <div class="h-48 bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $major->nama_jurusan }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($major->deskripsi, 100) }}</p>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">Pelajari Lebih Lanjut →</a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('konsultasi.form') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
                    Lihat Semua Jurusan
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Cara Kerja</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Tiga langkah mudah untuk menemukan jurusan kuliah impian Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-indigo-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Isi Tes Psikologi</h3>
                    <p class="text-gray-600">Jawab serangkaian pertanyaan yang dirancang untuk mengidentifikasi minat, bakat, dan kepribadian Anda.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-indigo-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Dapatkan Hasil</h3>
                    <p class="text-gray-600">Sistem kami akan menganalisis jawaban Anda dan memberikan rekomendasi jurusan yang paling cocok.</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-indigo-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Eksplorasi Jurusan</h3>
                    <p class="text-gray-600">Pelajari lebih lanjut tentang jurusan yang direkomendasikan dan buat keputusan yang tepat untuk masa depan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Apa Kata Mereka?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Dengarkan pengalaman mereka yang telah menemukan jurusan impian melalui JurusanKu</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="bg-gray-50 rounded-lg p-8 shadow-lg testimonial-card">
                    <div class="flex items-center mb-4">
                        <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $testimonial['name'] }}</h4>
                            <p class="text-gray-600">{{ $testimonial['major'] }} - {{ $testimonial['university'] }}</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"{{ $testimonial['quote'] }}"</p>
                    <div class="flex mt-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Menemukan Jurusan Impian Anda?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Bergabunglah dengan ribuan siswa yang telah menemukan jurusan kuliah yang tepat melalui tes kami</p>
            <a href="{{ route('konsultasi.form') }}" class="bg-white text-indigo-600 hover:bg-gray-100 font-bold py-3 px-8 rounded-lg text-lg transition duration-300">
                <i class="fas fa-play-circle mr-2"></i>Mulai Tes Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-graduation-cap text-indigo-400 text-2xl mr-2"></i>
                        <span class="font-bold text-xl">JurusanKu</span>
                    </div>
                    <p class="text-gray-400">Platform tes psikologi untuk membantu siswa menemukan jurusan kuliah yang tepat.</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Fitur</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Tes Psikologi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Rekomendasi Jurusan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Info Karir</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Perusahaan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Tim</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Karir</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center"><i class="fas fa-envelope mr-2"></i>info@jurusanku.com</li>
                        <li class="flex items-center"><i class="fas fa-phone mr-2"></i>(021) 1234-5678</li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">&copy; 2025 JurusanKu. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin text-xl"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>