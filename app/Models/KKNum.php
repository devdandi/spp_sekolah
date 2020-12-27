<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KKNum extends Model
{
    use HasFactory;
    protected $table = "kk";
    protected $fillable = ['kk_num'];
}
