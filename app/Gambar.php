<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $table = "gambar";

    protected $fillable = ['judul_novel','file', 'penulis_novel', 'sinopsis_novel'];

    public function chapter(){
        return $this->hasOne('App\chapter');
    }
}
