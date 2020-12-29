<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use Auth;

class MajorController extends Controller
{
    protected $major;

    function __construct(Major $m)
    {
        $this->major = $m;
    }
    public function index()
    {
        $major = $this->major->paginate(10);
        return view('admin.major.index', compact('major'));
    }
    public function destroy(Request $req, $id)
    {
        $major = $this->major->find($id);

        if($major->delete())
        {
            return redirect()->back()->with(['success' => ' Berhasil di hapus !']);
        }else{
            return redirect()->back()->with(['error' => ' gagal di hapus !']);

        }
    }
    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required'
        ]);
        $store = $this->major->create([
            'name' => $req->name
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
        return view('admin.major.add');
    }
}
