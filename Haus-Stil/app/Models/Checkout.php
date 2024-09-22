<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'country',
        'firstname',
        'lastname',
        'address',
        'postal_number',
        'phone',
        'card_number',
        'expire_date',
        'ccv',
        'card_name'
    ];
}
