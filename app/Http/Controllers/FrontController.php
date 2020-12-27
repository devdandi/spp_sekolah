<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Tunggakan;
use App\Models\Transaction;
use App\Models\Midtrans as MidtransModel;
use Illuminate\Support\Facades\Storage;



use Illuminate\Support\Facades\Auth;
use Midtrans;
use App\Http\Controllers\MidtransController;


class FrontController extends Controller
{
    protected $parent,
              $student,
              $tunggakan,
              $transaction;
    function __construct(Parents $p, Student $s, Tunggakan $t, Transaction $ts)
    {
        $this->transaction = $ts;
        $this->parent = $p;
        $this->student = $s;
        $this->tunggakan = $t;
    }
    public function index()
    {
        $total = 0;
        $total += $this->tunggakan->where('parent_id', Auth::id())->where('status', 'no_paid')->sum('total');
        return view('frontend.index', compact('total'));
    }
    public function show()
    {
        if(Auth::guard('parent')->check())
        {
            return redirect()->intended(route('user.index'));
        }
        return view('frontend.login.index');
    }
    public function login(Request $req)
    {
        $cred = $req->only('email','password');

        if(Auth::guard('parent')->attempt($cred))
        {
            $req->session()->regenerate();
            return redirect()->intended(route('user.index'));
        }else{
            // return redirect()->back()->with(['error' => 'Email atau password tidak di temukan !']);
            return redirect(route('user.show'))->with(['error' => 'Email atau password salah !']);
        }
    }
    public function siswa()
    {
        $student = $this->student->where('parent_id', Auth::id())->paginate(10);
        return view('frontend.siswa.index', compact('student'));
    }
    public function tagihan()
    {
        $tagihan = $this->tunggakan->where('parent_id', Auth::id())->where('status', 'no_paid')->get();
        return view('frontend.tagihan.index', compact('tagihan'));
    }
    public function logout(Request $req)
    {
        if(Auth::logout()) 
        {
            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect(route('user.show'));
        }
    }
    public function payment(Request $req)
    {
       $token = MidtransController::getSnap($req->checkbox);
       if($token)
       {
           return redirect(route('user.payment.show', $token));
       }
    }
    public function show_payment($snap)
    {
        if($snap === null)
        {
            return redirect()->back()->with(['error' => 'ada kesalahan ']);
        }
        $detail = $this->transaction->where('snap_token', $snap)->firstOrFail();
        return view('frontend.tagihan.show', compact('detail'));
    }
    public function payment_success($snap_token)
    {
        $detail = $this->transaction->where('snap_token', $snap_token)->where('status','success')->firstOrFail();
        return view('frontend.tagihan.success', compact('detail'));


    }
    public function payment_failed($snap_token)
    {
        $detail = $this->transaction->where('snap_token', $snap_token)->where('status', '!=' ,'success')->firstOrFail();
        return view('frontend.tagihan.failure', compact('detail'));


    }
}
