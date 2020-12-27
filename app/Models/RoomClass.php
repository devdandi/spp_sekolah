<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'classes',
        'major_id',
        'name',
        'full'
    ];
}