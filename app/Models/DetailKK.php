<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DetailKK extends Model
{
    use HasFactory;
    protected $table = "kkdetail";

    protected $fillable = ['kk_id','nik','name','place_of_birth','dob','status','jk','position'];

    public function kk()
    {
        return $this->belongsTo('App\Models\KKNum');
    }
}
