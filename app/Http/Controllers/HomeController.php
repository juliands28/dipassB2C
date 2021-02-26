<?php

namespace App\Http\Controllers;

use App\City;
use App\Order;
use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
// use Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $from_id = City::where('id', 189 )->where('city_name', 'Jakarta Barat' )->get();
        // $from_name = City::where('city_name', 'Jakarta Barat' )->get();
        
        
        // dd($from);
        // $to = City::where('id', '189' )->get();
        $kota = City::all();

        
        
        return view('pages.home',[
            'kota' => $kota,
            'from_id' => $from_id,
            // 'search' => $search,
        ]);
    }

    public function search()
    {
        
        $kota = City::all();

        
        return view('pages.home-search',[
                'kota' => $kota
            ]);
    }
    public function laravel()
    {
        
        // $kota = City::all();

        
        return view('home',[
                // 'kota' => $kota
            ]);
    }
}
