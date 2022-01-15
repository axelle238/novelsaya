<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gambar;
use App\chapter;
use Illuminate\Support\Facades\DB;
class DaftarNovelController extends Controller
{
    public function daftarnovel() {


        $categories = gambar::orderBy('judul_novel', 'asc')->get();

        $groups = $categories->reduce(function ($carry, $category) {

            // get first letter
            $first_letter = $category['judul_novel'][0];

            if ( !isset($carry[$first_letter]) ) {
                $carry[$first_letter] = [];
            }

            $carry[$first_letter][] = $category;

            return $carry;

        }, []);

        return view('daftarnovel')->with('groups', $groups);
    }
}
