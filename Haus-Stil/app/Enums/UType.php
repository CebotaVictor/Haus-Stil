<?php
namespace App\Enums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum UType : int{
    case Consumer = 1;
    case Vendor = 2;
    case Admin = 3;
    
    
    public static function getBy(int $slug)
    {
        return match ($slug) {
            1 => self::Consumer,
            2 => self::Vendor,
            3 => self::Admin,
            default => throw new \UnexpectedValueException("Unhandled match case for value: $slug"),
        };
    }
    
};

