<?php

namespace App\Http\Controllers;

use App\Bus;
use App\BusFacility;
use App\Order;
use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Carbon;

class BusDetailController extends Controller
{
    public function index(Request $request, $id)
    {
        
        $facility = Bus::all();
        $item = Schedule::with([
            'route',
            'route.arrival',
            'route.board_points',
            'route.points',
            'route.bus',
            'route.bus.busfacilities',
            'route.bus.facilities',
            'route.departure',
            'route.company',])
            ->findOrFail($id);

            // return $item;
            // return($item->route->bus->layout);
        return view('pages.bus_detail',[
            'item' => $item,
        ]);
    }
       
}
