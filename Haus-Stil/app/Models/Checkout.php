<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'country',
        'address',
        'postal_number',
        'city',
        'phone',
        'email',
        'card_number',
        'expire_date',
        'ccv',
        'card_name',
        'total_price',
    ];
}
