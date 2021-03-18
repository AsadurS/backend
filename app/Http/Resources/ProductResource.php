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
            'uuid' => $this->uuid,
            'title' => Str::limit($this->title, 30),
            'description' => Str::limit($this->description, 30),
            'price' => number_format($this->price,2),
            'deleteLink' => route('product.delete',$this->uuid),
            'updateLink' => route('product.update',$this->uuid),
            'image' =>asset('storage/image/product/' .$this->image),
        ];
    }
}
