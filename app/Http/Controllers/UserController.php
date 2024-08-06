<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function profile()
    {
        // Mengambil informasi pengguna yang sedang login
        $user = auth()->user();

        // Menampilkan halaman profil dengan data pengguna
        return view('auth.profile', compact('user'));
    }

    // public function updateProfile(Request $request, User $user)
    // {

    //     // Validasi data yang dikirimkan oleh pengguna
    //     $validatedData = $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'jenis_kelamin' => 'required|string|max:255',
    //         'nomor_telepon' => 'nullable|string|max:255',
    //         'alamat' => 'nullable|string|max:255',
    //         'gambar_profil' => 'nullable|image|mimes:jpeg,png,jpg',
    //     ]);

    //     // Mengambil foto profil lama untuk kemungkinan penghapusan setelah pembaruan
    //     $oldFoto = $pengguna->gambar_profil;
    //     $gambarProfil = $request->file('gambar_profil');

    //     // Jika terdapat pengiriman file gambar baru
    //     if ($request->hasFile('gambar_profil')) {

    //         // Membuat direktori penyimpanan jika belum ada
    //         if (!Storage::exists('public/profil')) {
    //             Storage::makeDirectory('public/profil');
    //         }

    //         // Menyimpan gambar profil baru
    //         $gambarProfil->store('public/profil');


    //         // Memperbarui nama file gambar profil
    //         $validatedData['gambar_profil'] = $gambarProfil->hashName();

    //         // Menghapus gambar profil lama jika ada
    //         if ($oldFoto) {
    //             Storage::disk('public/profil')->delete($oldFoto);
    //         }
    //     }

    //     // Memperbarui informasi pengguna dengan data yang divalidasi
    //     $pengguna->update($validatedData);

    //     // Mengarahkan kembali ke halaman sebelumnya dengan pesan sukses
    //     return redirect()->back()->with('success', 'Profil Berhasil diperbarui');
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
