<?php

namespace App\Http\Controllers;

use App\Route;
use App\Schedule;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class BusListController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $date = $request->date;
        $kota = City::all();

        // $search = DB::table('cities')->select()->where([
        //     ['city_name','=',$from],
        //     ['city_name','=',$to],
        // ])->get();

        // dd($search);

        $routes = Route::with(['arrival','bus'])->get();
        $schedules = Schedule::with([
            'route',
            'services.dropping',
            'route.arrival',
            'route.board_points',
            'route.points',
            'route.bus',
            'route.bus.facilities',
            'route.departure',
            'route.company',

        ])->get();
        // dd($schedules);
        return view('pages.bus_list',[
            'schedules' => $schedules,
            'total' => $schedules->count(),
            'routes' => $routes,
            'from' => $from,
            'to' => $to,
            'date' => $date,
            'kota' => $kota,
        ]);
    }

    public function detail(Request $request, $id)
    {
        $item = Schedule::with([
            'route',
            'route.arrival',
            'route.board_points',
            'route.points',
            'route.bus',
            'route.bus.facilities',
            'route.departure',
            'route.company',
 
        ])->findOrFail($id);

        
        return view('pages.bus_detail',[
            'item' => $item
        ]);
    }

    public function search(Request $request)
    {
        $departure_city = $request->departure_city;
        $arrival_city = $request->arrival_city;
        $date = $request->date;

        $kota = City::all();
        $schedule = Schedule::with([
            'services' => function($query) use($request) {
                $query->whereHas('pickup.city', function($q) use($request){
                    $q->where('id', '=', $request->departure_city);
                })->whereHas('dropping.city', function($q) use($request){
                    $q->where('id', '=', $request->arrival_city);
                })->when($request->departure_point, function($q) use($request){
                    $q->whereHas('pickup', function($q) use($request){
                        $q->where('id', '=', $request->departure_point);
                    });
                })->when($request->departure_point, function($q) use($request){
                    $q->whereHas('dropping', function($q) use($request){
                        $q->where('id', '=', $request->arrival_point);
                    });
                });
            },
            'services.pickup.city', 
            'services.dropping.city', 
            'route.departure', 
            'route.arrival', 
            'route.points.city', 
            'route.bus.class', 
            'route.bus.category', 
            'route.bus.facilities'
        ])
        ->whereHas('route', function(Builder $builder){
            $builder->where('active', '=', 'Y');
        })
        ->when($request->departure_city, function($query) use ($request) {
            return $query->whereHas('route.board_points.point.city', function(Builder $builder) use ($request) {
                $builder->where('id', '=', $request->departure_city);
            });
        })
        ->when($request->arrival_city, function($query) use ($request) {
            return $query->whereHas('route.board_points.point.city', function(Builder $builder) use ($request) {
                $builder->where('id', '=', $request->arrival_city);
            });
        })
        ->when($request->departure_point, function($query) use ($request) {
            return $query->whereHas('route.board_points', function(Builder $builder) use ($request) {
                $builder->where('point_id', '=', $request->departure_point)
                        ->where('pickup_point', '=', 1);
            });
        })
        ->when($request->arrival_point, function($query) use ($request) {
            return $query->whereHas('route.board_points', function(Builder $builder) use ($request) {
                $builder->where('point_id', '=', $request->arrival_point)
                        ->where('drop_point', '=', 1);
            });
        })
        ->where('date', '=', date('Y-m-d', strtotime($request->date)))
        ->get();
        
        // dd($schedule);
        // return $schedule;
        
        return view('pages.bus_list-search',[
                'schedule' => $schedule,
                'total' => $schedule->count(),
                'kota' => $kota,
                'departure_city' => $departure_city,
                'arrival_city' => $arrival_city,
                'date' => $date
            ]);
    }
  
}
