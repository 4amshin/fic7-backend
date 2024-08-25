<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Product::class, 'product');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['user', 'category'])->paginate(5);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', Product::class);

        $validatedData = $request->validated();

        if ($validatedData) {
            $product = Product::create($validatedData);

            $product->load(['user', 'category']);
            return new ProductResource($product);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $productApi)
    {
        $productApi->load(['user', 'category']);

        return new ProductResource($productApi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $productApi)
    {
        $this->authorize('update', Product::class);

        $validatedData = $request->validated();

        if ($validatedData) {
            $productApi->update($validatedData);

            $productApi->load(['user', 'category']);
            return new ProductResource($productApi);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $productApi)
    {
        $this->authorize('delete', Product::class);

        try {
            $productApi->delete();

            return response()->json([
                'message' => 'Product Berhasil Dihapus.'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal Menghapus Product',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
