<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parents;
use App\Models\Tunggakan;


class TagihanController extends Controller
{
    protected $parent, $tunggakan;

    function __construct(Parents $p, Tunggakan $t)
    {
        $this->parent = $p;
        $this->tunggakan = $t;
    }

    public function index($parent_id)
    {
        if($parent_id === null)
        {
            return redirect()->back();
        }
        // $tagihan = $this->tunggakan->where('parent_id', $parent_id)->where('status', 'no_paid')->get();
        $parent = $this->parent->find($parent_id);
        return view('admin.tagihan.index', [
            'parent' => $parent
        ]);
    }
    public function show(Request $req, $id)
    {
        if($id === null)
        {
            return redirect()->back();
        }
        $data = $this->tunggakan->find($id);
        $data->status = "paid";
        $data->updated_at = now();
        
        if($data->save())
        {
            return redirect()->back()->with(['success' => 'Pembayaran Berhasil']);
        }else{
            return redirect()->back()->with(['error' => 'Pembayaran Gagal']);

        }
    }
    public function show_all(Request $req, $id)
    {
        if($id === null)
        {
            return redirect()->back();
        }
        $tunggakan = $this->tunggakan->where('parent_id', $id)->get();
        
        foreach($tunggakan as $t)
        {
            $t->status = "paid";
            $t->save();
        }
        return redirect()->back()->with(['success' => 'Pembayaran berhasil !']);
    }
}
