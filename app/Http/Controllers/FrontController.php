<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Tunggakan;
use App\Models\Transaction;
use App\Models\News;

use App\Models\Midtrans as MidtransModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Midtrans;
use App\Http\Controllers\MidtransController;
use Illuminate\Support\Facades\Hash;


class FrontController extends Controller
{
    protected $parent,
              $student,
              $tunggakan,
              $news,
              $transaction;
    function __construct(Parents $p, Student $s, Tunggakan $t, Transaction $ts, News $n)
    {
        $this->transaction = $ts;
        $this->parent = $p;
        $this->student = $s;
        $this->tunggakan = $t;
        $this->news = $n;
    }
    public function index()
    {
        $total = 0;
        $total += $this->tunggakan->where('parent_id', Auth::id())->where('status', 'no_paid')->sum('total');
        $new = $this->news->paginate(3);
        return view('frontend.index', compact('total','new'));
    }
    public function show()
    {
        if(Auth::guard('parent')->check())
        {
            return redirect()->intended(route('user.index'));
        }
        return view('frontend.login.index');
    }
    public function login_post(Request $req)
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
        // $client_key = new MidtransController;
        return view('frontend.tagihan.index', compact('tagihan'));
    }
    public function logout(Request $req)
    {
        if(Auth::guard('parent')->logout()) 
        {
            $req->session()->invalidate();

            $req->session()->regenerateToken();
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
        if(isset($_GET['transaction_status'])){
            $status = $_GET['transaction_status'];
            if($status === 'pending')
            {
                return redirect(route('user.payment.pending', $snap));
            }else if($status === 'success' || $status == 'capture')
            {
                return redirect(route('user.payment.success', $snap));
            }
        }
        if($snap === null)
        {
            return redirect()->back()->with(['error' => 'ada kesalahan ']);
        }
        $detail = $this->transaction->where('snap_token', $snap)->firstOrFail();
        return view('frontend.tagihan.show', compact('detail'));
    }
    public function payment_success($snap_token)
    {
        $detail = $this->transaction->where('snap_token', $snap_token)->where('status','success')->orWhere('status','capture')->firstOrFail();
        return view('frontend.tagihan.success', compact('detail'));


    }
    public function payment_failed($snap_token)
    {
        $detail = $this->transaction->where('snap_token', $snap_token)->where('status', '!=' ,'success')->firstOrFail();
        return view('frontend.tagihan.failure', compact('detail'));
    }
    public function payment_pending($snap_token)
    {
        $detail = $this->transaction->where('snap_token', $snap_token)->where('status', '!=' ,'success')->firstOrFail();
        return view('frontend.tagihan.pending', compact('detail'));
    }
    public function transaction()
    {
        $success = $this->transaction->where('parent_id', Auth::id())->where('status', 'success')->orderBy('created_at','ASC')->paginate(5);
        $pending = $this->transaction->where('parent_id', Auth::id())->where('status', 'waiting_payment')->orderBy('created_at','ASC')->paginate(5);
        $failure = $this->transaction->where('parent_id', Auth::id())->where('status', 'failure')->orderBy('created_at','ASC')->paginate(5);
        return view('frontend.transaksi.index', compact('success','pending','failure'));
    }
    public function update(Request $req)
    {

        $update = $this->parent->find(Auth::id());
        $update->password = Hash::make($req->password);
        if($update->save())
        {
            return redirect()->back()->with(['success' => 'berhasil di perbarui !']);
        }else{
            return redirect()->back()->with(['error' => 'gagal di perbarui !']);

        }
    }
    public function show_update()
    {
        $user = $this->parent->find(Auth::id());
        return view('frontend.login.update', compact('user'));
    }
    public function read($slug)
    {
        $new = $this->news->where('slug', $slug)->firstOrFail();
        // dd($new);
        return view('frontend.news.index', compact('new'));
    }
}