<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chapter extends Model
{
    protected $table = "uploadchapter";

    protected $fillable = ['judul_novel','judul_chapter','isi_chapter'];

    public function Gambar(){
        return $this->belongsTo('App\Gambar');
    }
}

