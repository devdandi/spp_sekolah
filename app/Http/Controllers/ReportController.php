<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tunggakan;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Parents;




class ReportController extends Controller
{
    protected $parent,
              $student,
              $tunggakan;
    function __construct(Student $s, Parents $p, Tunggakan $t)
    {
        $this->parent = $p;
        $this->student = $s;
        $this->tunggakan = $t;
    }
    public function index()
    {
        return view('admin.laporan.index');
    }
    public function filter()
    {
       if(!isset($_GET['status']))
       {
            $tunggakan = $this->tunggakan->paginate(10);
            return view('admin.laporan.filter', compact('tunggakan'));
       }else{
           $status = $_GET['status'];

           if($status === "lunas")
           {
                $tunggakan = $this->tunggakan->where('status','paid')->paginate(10);
                return view('admin.laporan.filter', compact('tunggakan'));
           }else{
                $tunggakan = $this->tunggakan->where('status','no_paid')->paginate(10);
                return view('admin.laporan.filter', compact('tunggakan'));
           }
       }
    }
    public function filter_tanggal(Request $req)
    {
        $tunggakan = $this->tunggakan->whereBetween('updated_at', [$req->dari, $req->sampai])->paginate(10);
        return view('admin.laporan.filter', compact('tunggakan'));
    }
}
