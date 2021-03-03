<?php

namespace App\Http\Controllers;

use App\Order;
use App\Schedule;
use Illuminate\Http\Request;
use App\Helpers\CodeHelper;
use App\Http\Requests\OrderRequest;
use App\OrderDetail;
use App\OrderPassenger;
use App\OrderProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BusPesanController extends Controller
{
    public function index(Request $request, $id)
    {
        $schedule = Schedule::with([
            'services',
            'services.pickup.city', 
            'services.dropping.city', 
            'route.departure', 
            'route.arrival', 
            'route.points.city', 
            'route.bus.class', 
            'route.bus.category', 
            'route.bus.facilities'
        ])->findOrFail($id);


        return view('pages.bus_pesan',[
            'schedule' => $schedule
        ]);
    }
    

    public function process(OrderRequest $request, $id)
    {
        $schedule = Schedule::with('route')->findOrFail($id); 
        $user = $request->created_by;

        // dd($user);

        $order = Order::create([
                'schedule_id' => $id,
                'route_id' => $schedule->route_id,
                'order_no' => CodeHelper::dateCode('ORD', 'orders', 'order_no'),
                'departure_city' => $schedule->route->departure_id,
                'departure_point' => $schedule->route->points->first()->id,
                'departure_date' => $schedule->date,
                'departure_time' => $schedule->route->board_points->first()->time,
                'arrival_city' => $schedule->route->arrival_id,
                'arrival_point' => $schedule->route->points->last()->id,
                'arrival_date' => $schedule->date,
                'arrival_time' => $schedule->route->board_points->last()->time,
                'date' => date('Y-m-d H:i:s'),
                'expired_date' => date("Y-m-d H:i:s", strtotime("+2 hours")),
                'total_price' => $schedule->price,
                'status' => 'Pending',
                'created_by' => $user,
        ]);

        // dd($order);
        // return $order;
        
        $order->detail()->insert([
            [
                'order_id' => $order->id, 
                'name' =>  ucwords($request->name), 
                'phone' => $request->phone, 
                'email' => $request->email
            ]
        ]);

        $order->passengers()->insert([
            [
                'order_id' => $order->id, 
                'name' => ucwords($request->passenger_name),
                'nik' => $request->passenger_nik,
                'seat_number' => $request->passenger_seat_number,
                'age' => $request->passenger_age,
                'pax_price' => $schedule->price,
                'gender' => $request->passenger_gender,
            ]
        ]);
        $order->save();

        $order_provider = new OrderProvider;
                
            $order_provider->order_id = $order->id;
            $order_provider->company_id = $schedule->route->company_id;

            $order_provider->save();

            return redirect()->route('checkout-success', $order->id);
    }


    public function success(Request $request, $id)
    {
        $order = Order::with([
            'schedule', 
            'route', 
            'detail', 
            'payment', 
            'payment.upload', 
            'passengers', 
            'departureCity', 
            'departurePoint',
            'arrivalCity',
            'arrivalPoint',
        ])->findOrFail($id);
        // dd($order);

        return view('pages.pesan_sukses',[
            'order' => $order
        ]);
    }

    public function sukses()
    {
        return view('pages.pesan_sukses');
    }

}
