<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomClass;
use App\Models\Major;

class ClassController extends Controller
{
    protected $class;

    function __construct(RoomClass $r, Major $m)
    {
        $this->major = $m;
        $this->class = $r;
    }
    public function index()
    {
        $class = $this->class->paginate(10);
        return view('admin.class.index', compact('class'));
    }
    public function destroy(Request $req, $id)
    {
        $class = $this->class->find($id);

        if($class->delete())
        {
            return redirect()->back()->with(['success' => ' Berhasil di hapus !']);
        }else{
            return redirect()->back()->with(['error' => ' gagal di hapus !']);

        }
    }
    public function store(Request $req)
    {
        $validated = $req->validate([
            'tingkat_kelas' => 'required',
            'jurusan' => 'required',
            'max_siswa' => 'required',
            'nama_kelas' => 'required'
        ]);
        $store = $this->class->create([
            'classes' => $req->tingkat_kelas,
            'major_id' => $req->jurusan,
            'name' => $req->nama_kelas,
            'full' => $req->max_siswa
        ]);
        if($store)
        {
            return redirect()->back()->with(['success' => ' Berhasil di tambahkan !']);
        }else{
            return redirect()->back()->with(['error' => ' gagal di tambahkan !']);

        }
    }
    public function show()
    {
        $major = $this->major->all();
        return view('admin.class.add', compact('major'));
    }
}
