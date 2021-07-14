<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'description',
        'price',
        'stock',
        'contained_on',
        'acquired_on',
    ];

    public function container() {
        return $this->belongsTo('App\Models\Product', 'contained_on', 'id');
    }
}
