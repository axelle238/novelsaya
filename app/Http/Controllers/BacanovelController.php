<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gambar;
use App\chapter;
use Illuminate\Support\Facades\DB;

class BacanovelController extends Controller
{
    public function bacanovel($id){
        $data= DB::table('gambar')
        ->orderBy('judul_novel', 'asc')
        ->join('uploadchapter', 'uploadchapter.judul_novel', '=', 'gambar.judul_novel')->where('gambar.id',$id)
        ->select('uploadchapter.judul_novel', 'uploadchapter.judul_chapter', 'uploadchapter.isi_chapter', 'uploadchapter.id', 'gambar.file', 'gambar.sinopsis_novel AS sinopsis', 'gambar.judul_novel AS judul', 'gambar.penulis_novel AS penulis', 'gambar.created_at AS terbit')
        ->get();


        return view('/bacanovel',['data' => $data]);
    }

    public function bacachapter($id){
        $data= DB::table('uploadchapter')
        ->orderBy('id', 'asc')
        ->join('gambar', 'uploadchapter.judul_novel', '=', 'gambar.judul_novel')->where('uploadchapter.id',$id)
        ->select('gambar.id AS gambar_id','uploadchapter.judul_novel', 'uploadchapter.judul_chapter', 'uploadchapter.isi_chapter', 'uploadchapter.id', 'gambar.file', 'gambar.sinopsis_novel AS sinopsis', 'gambar.judul_novel AS judul', 'gambar.penulis_novel AS penulis', 'gambar.created_at AS terbit')
        ->get();

        return view('/bacachapter',['data' => $data]);
    }

}
