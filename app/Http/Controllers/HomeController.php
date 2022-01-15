<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Home()
    {

        return view('home');
    }

    public function Beranda()
    {

        return view('beranda');
    }

}
