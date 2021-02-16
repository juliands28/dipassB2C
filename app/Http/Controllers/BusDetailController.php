<?php

namespace App\Http\Controllers;

use App\Bus;
use App\BusFacility;
use Illuminate\Http\Request;
use App\Schedule;

class BusDetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $facility = Bus::all();
        // $facility = BusFacility::with('facility');
        // dd($facility);
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
            // dd($item);
        return view('pages.bus_detail',[
            'item' => $item,
            
            // 'facility' => $facility
        ]);
    }
       
}
