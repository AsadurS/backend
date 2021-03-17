<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function store(Request $request)
    {

        if($request->file('image')) {
            $fileName =time().'_'.$request->image->getClientOriginalName();
          
            $filePath=  $request->file('image')->storeAs('public/image/product', $fileName);
        //    File::get(storage_path('app/' .$filePath));
        }
      return Product::create([
          'uuid'=>Str::orderedUuid()->toString(),
          'title'=>$request->title,
          'description'=>$request->description,
          'price'=>$request->price,
          "image"=>$fileName,
          'user_id'=>1
      ]);
    }

    public function manage()
    {
        $products = Product::all();

        $products = ProductResource::collection(Product::all());
        return  response()->json(['products'=> $products]);
    }
}
