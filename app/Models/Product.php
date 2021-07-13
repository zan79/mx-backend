<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'contained_on',
        'acquired_on',
        'status'
    ];

    public function container() {
        return $this->belongsTo('App\Models\Product', 'contained_on', 'id');
    }
}
