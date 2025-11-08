<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Method untuk menampilkan halaman utama
    public function index()
    {
        return view('home'); // Ganti 'home' dengan nama view yang sesuai
    }
}
