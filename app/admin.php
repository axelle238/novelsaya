<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class admin extends Model
{
    protected $table = "admin";

    protected $fillable = ['nama_pengguna','email','password'];

    public function admin(){
        return $this->hasOne('App\admin');
    }
}
