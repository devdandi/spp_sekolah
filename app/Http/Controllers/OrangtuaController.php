<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Level;
use App\Models\KKNum;
use App\Models\DetailKK;
use App\Models\Major;
use Excel;
use App\Imports\DetailKKImport;

class OrangtuaController extends Controller
{
    protected $parent, $student, $level, $kknum, $detailkk;
    public $parent_array = array();

    function __construct(Parents $p, Student $s, Level $l, KKNum $k, DetailKK $d, Major $m)
    {
        $this->major = $m;
        $this->kknum = $k;
        $this->detailkk = $d;
        $this->level = $l;
        $this->parent = $p;
        $this->student = $s;
    }
    public function index()
    {
        // dd($this->parent);
        $orangtua = $this->parent->paginate(10);

        return view('admin.parent.index', compact('orangtua'));
    }
    public function show()
    {
        $level = $this->level->all();
        return view('admin.parent.add', compact('level'));    
    }
    public function store(Request $req)
    {
        // dd($req);
        $validated = $req->validate([
            'email' => 'required|unique:parents|max:255',
            'nik' => 'required|unique:kkdetail|max:16',
            'nama' => 'required',
            'dob' => 'required',
            'keterangan' => 'required',
            'kk_id' => 'required',
            'tempat_lahir' => 'required'
        ]);


        $store = $this->detailkk->create([
            'kk_id' => $req->kk_id,
            'nik' => $req->nik,
            'name' => $req->nama,
            'place_of_birth' => $req->tempat_lahir,
            'dob' => $req->dob,
            'jk' => $req->jk,
            'position' => $req->keterangan
        ]);

        
        if($store)
        {
            if($req->keterangan === "Istri" || $req->keterangan === "Suami" || $req->keterangan === "Wali")
            {
                $this->parent->create([
                    'kk_id' => $req->kk_id,
                    'email' => $req->email,
                    'kkdetail_id' => $store->id,
                    'password' => Hash::make($req->password),
                    'level_id' => 3
                ]);
            }else{
                $this->student->create([
                    'parent_id' => $req->parent_id,
                    'kk_id' => $req->kk_id,
                    'email' => $req->email,
                    'kkdetail_id' => $store->id,
                    'password' => Hash::make($req->password),
                    'level_id' => 3,
                    'major_id' => $req->jurusan
                ]);
            }
            return redirect()->back()->with(['success' => $req->nama . ' Berhasil di tambahkan !']);
        }else{
            return redirect()->back()->with(['error' => $req->nama . ' Gagal di tambahkan !']);

        }
    }
    public function details_family($id)
    {
        $kk_num = $this->kknum->find($id);
        $detail_kk = $this->detailkk->where('kk_id', $kk_num->id)->paginate(10);
        $jurusan = $this->major->all();
        return view('admin.parent.add', compact('kk_num','detail_kk','jurusan'));
    }
    public function destroy(Request $req, $id)
    {
        if($id === null)
        {
            return redirect()->back()->with(['error' => 'Ada kesalahan !']);
        }
        $destroy = $this->detailkk->find($id);
        
        if($destroy->delete())
        {
            return redirect()->back()->with(['success' => $destroy->name . ' telah di hapus']);
        }
    }

    
}
