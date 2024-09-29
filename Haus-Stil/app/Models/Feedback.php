<?php

namespace App\Models;

use App\Enums\UType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'message',
        'user_id',
        'user_type'
    ];



    protected function casts(): array
    {
        
        return [
            'user_type' => UType::class,
            'email_verified_at' => 'datetime',
        ];
    }
}

