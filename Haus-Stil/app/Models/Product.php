<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'descripiton',
        'price',
        'imageName',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
