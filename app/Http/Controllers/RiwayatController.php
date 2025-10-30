<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RiwayatKonsultasi;

class RiwayatController extends Controller
{
    /**
     * Menampilkan daftar riwayat konsultasi untuk user yang sedang login.
     */
    public function index()
    {
        $riwayats = RiwayatKonsultasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('riwayat.index', compact('riwayats'));
    }

    public function show($id)
    {
        $riwayat = RiwayatKonsultasi::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('riwayat.show', compact('riwayat'));
    }

    public function destroy($id)
    {
        $riwayat = RiwayatKonsultasi::where('user_id', Auth::id())
            ->findOrFail($id);

        $riwayat->delete();

        return redirect()->route('riwayat.index')
            ->with('success', 'Riwayat tes berhasil dihapus');
    }
}
