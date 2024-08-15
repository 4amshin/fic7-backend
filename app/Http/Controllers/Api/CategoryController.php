<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return  CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();

        if ($validatedData) {
            $category = Category::create($validatedData);
            return new CategoryResource($category);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('products');
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();

        if ($validatedData) {
            $category->update($validatedData);
            return new CategoryResource($category);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Proses penghapusan kategori
            $category->delete();

            // Mengembalikan respon sukses
            return response()->json([
                'message' => 'Kategori berhasil dihapus.'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            // Jika terjadi error, mengembalikan respon gagal
            return response()->json([
                'message' => 'Gagal menghapus kategori.',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
