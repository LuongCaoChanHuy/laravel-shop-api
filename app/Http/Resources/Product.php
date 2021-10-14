<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CallBack\Category;
use App\Http\Resources\CallBack\Author;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // 'title'
        // 'description'
        // 'price'
        // 'ratings'
        // 'reviews'
        // 'isAddedToCart'
        // 'isAddedBtn'
        // 'isFavourite'
        // 'quantity'
        // 'store'
        // 'image'
        return [
            'id' => $this->id,
            'author_id' => $this->author_id,
            'author' => new Author($this->author),
            'category_id' => $this->category_id,
            'category' => new Category($this->category),
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'ratings' => $this->ratings,
            'reviews' => $this->reviews,
            'isAddedToCart' => $this->isAddedToCart,
            'isAddedBtn' => $this->isAddedBtn,
            'isFavourite' => $this->isFavourite,
            'quantity' => $this->quantity,
            'store' => $this->store,
            'image' => $this->image,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
