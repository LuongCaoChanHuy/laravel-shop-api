<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory,SoftDeletes;
    public function order()
    {
        return $this->belongsTo(order::class);
    }
    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
