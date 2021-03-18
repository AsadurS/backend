<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\ProductResource;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends Controller
{
    public function store(CreateProductRequest $request, $success = true)
    {
        try {
            if ($request->file('image')) {
                $fileName = time() . '_' . $request->image->getClientOriginalName();

                $request->file('image')->storeAs('public/image/product', $fileName);
            }
            $product = Product::create([
                'uuid' => Str::orderedUuid()->toString(),
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                "image" => $fileName,
            ]);
        } catch (Exception $excption) {
            $success = false;
        }

        return response()->json(['success' => $success]);
    }

    public function update(UpdateProductRequest $request, $product)
    {
        try {
            $product =  Product::where('uuid', $product)->first();
            if ($request->file('image')) {
                $fileName = time() . '_' . $request->image->getClientOriginalName();
                // Storage::delete(public_path('public/image/product', $product->image));
                $request->file('image')->storeAs('public/image/product', $fileName);
            }
            $success = $product->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                "image" => $fileName,
            ]);
        } catch (Exception $excption) {
            return $excption;
            $success = false;
        }

        return response()->json(['success' => $success]);
    }

    public function manage($success = true)
    {

        try {
            $products = Product::all();

            $products = ProductResource::collection(Product::latest()->get());
        } catch (\Exception $e) {
            $success = false;
        }
        return  response()->json(['success' => $success, 'products' => $products]);
    }

    public function edit($product)
    {

        $product = Product::where('uuid', $product)->first();
        return response()->json(['product' => new ProductResource($product)]);
    }

/**
 * 
 */
    public function delete($product)
    {
        try {
            $product =  Product::where('uuid', $product)->delete();
        } catch (\Exception $e) {
            $product = false;
        }
        return response()->json(['success' => $product]);
    }
}
