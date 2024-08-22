<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid image file.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Proses penyimpanan gambar
        $image = $request->file('image');
        $fileName = time() . '.' . $image->getClientOriginalExtension();

        // Simpan gambar ke dalam folder 'public/products' menggunakan Laravel Storage
        $path = $image->storeAs('public/products', $fileName);

        // Cek apakah gambar berhasil disimpan
        if ($path) {
            return response()->json([
                'image_path' => Storage::url($path),
                'base_url' => url('/'),
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to upload image.'
            ], 500);
        }
    }

    public function uploadMultipleImage(Request $request)
    {
        if ($request->has('image')) {
            $images = $request->image;
            foreach($images as $key => $image) {
                $fileName = time() . $key . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/products', $fileName);
            }
            return response()->json([
                'status' => 'Upload Successfully',
            ]);
        }
    }
}
