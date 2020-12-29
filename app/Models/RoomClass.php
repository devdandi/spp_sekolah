<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Major;

class RoomClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'classes',
        'major_id',
        'name',
        'full'
    ];
    public function getMajorName($id)
    {
        return Major::find($id)->name;
    }
    public function student()
    {
        return $this->hasMany('App\Models\Student','class_id');
    }
}
