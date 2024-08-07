<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $daftarPengguna = User::when($request->input('search'), function($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.pengguna.daftar-pengguna', compact('daftarPengguna'))->with('showNavbar', true);
    }

    public function profile()
    {
        // Mengambil informasi pengguna yang sedang login
        $user = auth()->user();

        // Menampilkan halaman profil dengan data pengguna
        return view('auth.profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request, User $user)
    {
        $validatedData = $request->validated();
        // Mengambil foto profil lama untuk kemungkinan penghapusan setelah pembaruan
        $oldFoto = $user->profile_img;
        $gambarProfil = $request->file('profile_img');

        // Jika terdapat pengiriman file gambar baru
        if ($request->hasFile('profile_img')) {

            // Membuat direktori penyimpanan jika belum ada
            if (!Storage::exists('public/profie')) {
                Storage::makeDirectory('public/profie');
            }

            // Menyimpan gambar profil baru
            $gambarProfil->store('public/profile');


            // Memperbarui nama file gambar profil
            $validatedData['gambar_profil'] = $gambarProfil->hashName();

            // Menghapus gambar profil lama jika ada
            if ($oldFoto) {
                Storage::disk('public/profile')->delete($oldFoto);
            }
        }

        // Memperbarui informasi pengguna dengan data yang divalidasi
        $validatedData['password'] = Hash::make($validatedData['unhashed_password']);
        // dd($validatedData);
        $user->update($validatedData);

        // Mengarahkan kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Profil Berhasil diperbarui');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengguna.tambah-pengguna')->with('showNavbar', true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['unhashed_password']);

        User::create($validatedData);

        return redirect()->route('user.index')->with('success', 'User Added');
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
        return view('admin.pengguna.update-pengguna', compact('user'));
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
        $user->delete();

        return redirect()->route('user.index')->with('info', 'User Deleted');
    }
}
