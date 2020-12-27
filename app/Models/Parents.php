<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Parents extends Authenticatable
{

    use HasApiTokens;
    use HasFactory; 
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = "parents";

    protected $fillable = [
        'name',
        'kk_id',
        'kkdetail_id',
        'email',
        'password',
        'level_id',
        'dob'
    ];

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
    public function student()
    {
        return $this->hasMany('App\Models\Student','parent_id');
    }
    public function tunggakan()
    {
        return $this->hasMany('App\Models\Tunggakan','parent_id');
    }
}
