<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'products_id' => $this->products_id,
            'orders_id' => $this->orders_id,
            'price' => $this->price,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'product' => new Product($this->product),
            'order' => new Order($this->order)
        ];
    }
}
