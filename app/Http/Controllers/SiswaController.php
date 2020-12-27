<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Parents;
use App\Models\Major;
use App\Models\RoomClass;
use App\Models\Level;



class SiswaController extends Controller
{
    private $student, $parent, $major, $class, $level;

    function __construct(Parents $parent, Student $student, Major $major, RoomClass $rm, Level $l)
    {
        $this->level = $l;
        $this->major = $major;
        $this->class = $rm;
        $this->student = $student;
        $this->parent = $parent;
    }

    public function index()
    {
        return view('admin.siswa.index', ['siswa' => $this->getSiswa()]);
    }

    protected function getSiswa()
    {
        return $this->student->paginate(10);
    }
    // public function show($parent_id)
    // {
    //     // // dd($parent_id);
    //     if($parent_id === null)
    //     {
    //         return redirect(route('orangtua.show'))->with(['error' => 'Aduh, sepertinya ada kesalahan !']);
    //     }
    //     $major = $this->major->all();
    //     $parent_base = $this->parent->findOrFail($parent_id);
    //     return view('admin.siswa.add', compact('parent_base','major'));
    // }
    public function show_edit($id)
    {
        if($id === null)
        {
            return redirect()->back()->with(['error' => 'Ada kesalahan !']);
        }
        return view('admin.siswa.edit', [
            'major' => $this->major->all(),
            'siswa' => $this->student->find($id),
            'level' => $this->level->all(),
            'kelas' => $this->class->all()
        ]);
    }
    public function edit_proses(Request $req, $id)
    {
        $siswa = $this->student->find($id);
        $siswa->nisn = $req->nisn;
        $siswa->email = $req->email;
        $siswa->major_id = $req->major;
        $siswa->level_id = $req->level;
        $siswa->class_id = $req->kelas;

        if($siswa->save())
        {
            return redirect()->back()->with(['success' => $siswa->kkdetail->name . " berhasil di perbarui !"]);
        }else{
            return redirect()->back()->with(['error' => $siswa->kkdetail->name . " gagal di perbarui !"]);

        }
    }
}
