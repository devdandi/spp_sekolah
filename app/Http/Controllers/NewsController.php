<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\News;
use Auth;

class NewsController extends Controller
{
    protected $news;
    function __construct(News $n)
    {
        $this->news = $n;
    }
    public function index()
    {
        $new = $this->news->paginate(10);
        return view('admin.news.index', compact('new'));
        
    }
    public function store(Request $req)
    {
        $validated = $req->validate([
            'title' => 'required',
            'pesan' => 'required',
            'gambar' => 'mimes:jpg,bmp,png|nullable|max:2024'
        ]);

        if($req->hasFile('gambar'))
        {
            $filenameWithExt = $req->file('gambar')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $req->file('gambar')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $req->file('gambar')->storeAs('public/images', $filenameSimpan);
        }else{
            $filenameSimpan = null;
        }

        
        $store = $this->news->create([
            'user_id' => Auth::id(),
            'title' => $req->title,
            'slug' => Str::slug($req->title),
            'pesan' => $req->pesan,
            'gambar' => $filenameSimpan
        ]);
        if($store)
        {
            
            return redirect()->back()->with(['success' => 'Pemberitahuan telah di publikasi !']);
        }else{
            return redirect()->back()->with(['error' => 'Pemberitahuan gagal di publikasi !']);

        }
    }
    public function show()
    {
        return view('admin.news.add');
    }
    public function destroy(Request $req, $id)
    {
        $destroy = $this->news->find($id);
        if($destroy->delete())
        {
            return redirect()->back()->with(['success' => ' Berhasil di hapus ']);
        }else{
            return redirect()->back()->with(['error' => ' Gagal di hapus ']);

        }
    }

}
