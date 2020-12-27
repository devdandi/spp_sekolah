<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'kk_id',
        'kkdetail_id',
        'major_id',
        'class_id',
        'nisn',
        'email',
        'password',
        'level_id',
        'status'
    ];

    public function parent()
    {
        return $this->belongsTo('App\Models\Parents');
    }
    public function kk()
    {
        return $this->belongsTo('App\Models\KKNum');
    }
    public function kkdetail()
    {
        return $this->belongsTo('App\Models\DetailKK');
    }
    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }
    public function major()
    {
        return $this->belongsTo('App\Models\Major');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\RoomClass');
    }
}

