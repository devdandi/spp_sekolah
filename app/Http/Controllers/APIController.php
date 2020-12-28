<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KKNum;
use App\Models\DetailKK;
use App\Models\Tunggakan;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;



class APIController extends Controller
{
    protected $kknum, $detailkk, $tunggakan, $student, $transaksi;

    function __construct(KKNum $kknum, DetailKK $detailkk, Tunggakan $tunggakan, Student $student, Transaction $transaksi)
    {
        $this->transaksi = $transaksi;
        $this->student = $student;
        $this->tunggakan = $tunggakan;
        $this->kknum = $kknum;
        $this->detailkk = $detailkk;
    }

    public function kk_num_search(Request $req)
    {
        $data = $this->kknum->firstOrCreate([
            'kk_num' => $req->kk_num
        ]);
        return redirect(route('orangtua.detail', $data->id));
    }
    public function nik_search(Request $req)
    {
        $data = $this->detailkk->where('nik', $req->nik)->count();
        if($data > 0)
        {
            return false;
        }
        return true;
    }
    public function report_money_monthly(Request $req)
    {
        return Cache::remember('report_money_monthly', 5, function() {
            return $this->tunggakan->whereMonth('created_at', '=', Carbon::now()->month)->where('status','paid')->sum('total');
        });
    }
    public function report_money_monthly_tunggakan(Request $req)
    {
        return Cache::remember('report_money_monthly_tunggakan', 5, function() {
            return $this->tunggakan->whereMonth('created_at', '=', Carbon::now()->month)->where('status','no_paid')->sum('total');
        });
    }
    public function count_tunggakan(Request $req)
    {
        return Cache::remember('count_tunggakan', 5, function() {
            return $this->tunggakan->whereMonth('created_at', '=', Carbon::now()->month)->where('status','no_paid')->count();
        });
    }
    public function count_pembayaran(Request $req)
    {
        return Cache::remember('count_pembayaran', 5, function() {
            return $this->tunggakan->whereMonth('created_at', '=', Carbon::now()->month)->where('status','paid')->count();
        });
    }
    public function count_siswa(Request $req)
    {
        return Cache::remember('count_siswa', 5, function() {
            return $this->student->whereNotNull('nisn')->count();
        });
    }
    public function count_failure_payment(Request $req)
    {
        return Cache::remember('count_failure_payment', 5, function() {
            return $this->transaksi->where('status', 'failure')->count();
        });
    }
}
