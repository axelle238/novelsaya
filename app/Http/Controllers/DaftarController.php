<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DaftarController extends Controller
{
    public function index()
    {
        return view('daftar', [
            'title' => 'Daftar'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:5|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:255'
        ]);

        User::create($validatedData);

        return redirect('/login');
    }
}
