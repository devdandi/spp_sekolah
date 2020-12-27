<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Level;

class HomeController extends Controller
{
    protected $user, $level;
    
    function __construct(User $user, Level $level)
    {
        $this->user = $user;
        $this->level = $level;

    }

    public function index()
    {
        $user = $this->user->find(Auth::id());
        // dd($user->level->keterangan);
        return view('admin.index');
    }
    public function test()
    {
        $id = Auth::id();
        return $this->user->find($id);
    }
}
