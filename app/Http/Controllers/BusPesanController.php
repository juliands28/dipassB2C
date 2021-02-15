<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusPesanController extends Controller
{
    public function index()
    {
        return view('pages.bus_pesan');
    }
    
    public function sukses()
    {
        return view('pages.pesan_sukses');
    }
}
