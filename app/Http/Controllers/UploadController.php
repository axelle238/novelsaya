<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Gambar;
use App\chapter;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
	public function upload(){
		$gambar = Gambar::get();
		return view('upload',['gambar' => $gambar]);
	}

    public function novelsaya(Request $request){
        $gambar = DB::table('gambar')->orderByDesc('id', 'judul_novel')->get();
        $chapter = chapter::get();
        return view('novelsaya',['gambar' => $gambar], ['chapter' => $chapter]);
    }

    public function upload_chapter(){
        $chapter = chapter::get();
        return view('uploadchapter',['chapter' => $chapter]);
    }

    public function chaptersaya($id){
        $data= DB::table('gambar')
        ->orderByDesc('id', 'judul_novel')
        ->join('uploadchapter', 'uploadchapter.judul_novel', '=', 'gambar.judul_novel')->where('gambar.id',$id)
        ->select('uploadchapter.judul_novel', 'uploadchapter.judul_chapter', 'uploadchapter.isi_chapter', 'uploadchapter.id', 'gambar.file', 'gambar.sinopsis_novel AS sinopsis', 'gambar.judul_novel AS judul', 'gambar.penulis_novel AS penulis', 'gambar.created_at AS terbit')
        ->get();

        return view('/chapternovel',['data' => $data]);
    }



	public function proses_upload(Request $request){
		$this->validate($request, [
            'email' => 'required',
            'judul_novel' => 'required',
			'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'penulis_novel'=> 'required',
			'sinopsis_novel' => 'required',

		]);

		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');

		$nama_file = time()."_".$file->getClientOriginalName();

      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);

		Gambar::create([
            'email' => $request->email,
            'judul_novel' => $request->judul_novel,
			'file' => $nama_file,
            'penulis_novel' => $request->penulis_novel,
			'sinopsis_novel' => $request->sinopsis_novel,
		]);

		return redirect('/novelsaya');
	}

    public function deletenovel($id){
    $gambar = Gambar::find($id);
    $gambar->delete();
    return redirect()->back();
}

public function deletechapter($id){
    $gambar = chapter::find($id);
    $gambar->delete();
    return redirect('/novelsaya');
}

    public function proses_upload_chapter(Request $request){
		$this->validate($request, [
            'judul_novel' => 'required',
			'judul_chapter' => 'required',
			'isi_chapter' => 'required',
		]);

        Chapter::create([
            'judul_novel' => $request->judul_novel,
			'judul_chapter' => $request->judul_chapter,
			'isi_chapter' => $request->isi_chapter,
		]);

		return redirect('/novelsaya');
    }

    public function daftarnovel(){
        $gambar = DB::table('gambar')->orderByDesc('id', 'judul_novel')->get();
        $chapter = chapter::get();
        return view('daftarnovel',['gambar' => $gambar], ['chapter' => $chapter]);
    }


    public function editchapter($id){
        $data= DB::table('uploadchapter')
        ->join('gambar', 'uploadchapter.judul_novel', '=', 'gambar.judul_novel')->where('uploadchapter.id',$id)
        ->select('gambar.judul_novel', 'uploadchapter.judul_chapter', 'uploadchapter.isi_chapter', 'gambar.file', 'gambar.sinopsis_novel AS sinopsis', 'gambar.judul_novel AS judul', 'uploadchapter.id AS id_chapter', 'gambar.penulis_novel AS penulis', 'gambar.created_at AS terbit')
        ->get();


        return view('/editchapter',['data' => $data]);
    }

    public function proses_edit_chapter(Request $request){
		DB::table('uploadchapter')->where('id', $request->id)
        -> update([
            'judul_novel' => $request->judul_novel,
			'judul_chapter' => $request->judul_chapter,
			'isi_chapter' => $request->isi_chapter,
		]);

		return redirect('/novelsaya');
    }
}
