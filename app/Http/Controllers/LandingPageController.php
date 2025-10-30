<?php  
namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\RiwayatKonsultasi;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
public function index()
{
// Ambil beberapa jurusan untuk ditampilkan
$featuredMajors = Jurusan::inRandomOrder()->limit(6)->get();

// Ambil statistik untuk ditampilkan
$stats = [
'totalMajors' => Jurusan::count(),
'totalTests' => RiwayatKonsultasi::count(),
'totalUsers' => \App\Models\User::count(),
];

// Ambil testimoni (bisa dari database atau hardcoded)
$testimonials = [
[
'name' => 'Rizki Ahmad',
'major' => 'Teknik Informatika',
'university' => 'Universitas Indonesia',
'quote' => 'Aplikasi ini sangat membantu saya menemukan jurusan yang sesuai dengan minat dan bakat saya. Sekarang saya sudah berkuliah di jurusan impian saya!',
'avatar' => 'https://picsum.photos/seed/user1/200/200.jpg'
],
[
'name' => 'Siti Nurhaliza',
'major' => 'Psikologi',
'university' => 'Universitas Gadjah Mada',
'quote' => 'Saya bingung memilih jurusan, tapi setelah menggunakan tes ini, saya jadi tahu bahwa Psikologi adalah pilihan yang tepat untuk saya.',
'avatar' => 'https://picsum.photos/seed/user2/200/200.jpg'
],
[
'name' => 'Budi Santoso',
'major' => 'Desain Komunikasi Visual',
'university' => 'Institut Teknologi Bandung',
'quote' => 'Tes ini sangat akurat dan memberikan rekomendasi jurusan yang sesuai dengan kepribadian saya. Sangat direkomendasikan untuk calon mahasiswa!',
'avatar' => 'https://picsum.photos/seed/user3/200/200.jpg'
],
];

return view('landing', compact('featuredMajors', 'stats', 'testimonials'));
}
}