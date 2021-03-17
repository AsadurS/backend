<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => Str::limit($this->title, 20),
            'price' => number_format($this->price,2),
            'deleteLink' => route('product.delete',$this->uuid),
            'editLink' => route('product.update',$this->uuid),
            'image' =>asset('storage/image/product/' .$this->image),
        ];
    }
}
