<?php

namespace App\Http\Controllers;

use App\BookingOrder;
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
        $kota = City::all();

        return view('pages.home',[
            'kota' => $kota,
            'from_id' => $from_id,
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
        $booking = BookingOrder::with(['order','booking'])->get();
        dd($booking);
        return view('home',[
                'booking' => $booking
            ]);
    }
}
