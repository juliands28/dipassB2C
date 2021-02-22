<?php

namespace App\Http\Controllers;

use App\Order;
use App\Schedule;
use Illuminate\Http\Request;
use App\Helpers\CodeHelper;
use App\Http\Requests\OrderRequest;
use App\OrderDetail;
use App\OrderPassenger;
use Illuminate\Support\Facades\Validator;

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
    public function order(OrderRequest $request, $id)
    {
         // $travel_package = TravelPackage::findOrFail($id);

        // $transaction = Transaction::create([
        //     'travel_packages_id' => $id,
        //     'users_id' => Auth::user()->id,
        //     'additional_visa' => 0,
        //     'transaction_total' => $travel_package->price,
        //     'transaction_status' => 'IN_CART'
        // ]);

        $schedule = Schedule::findOrFail($id); 

        $order = Order::create([
                'schedule_id' => $id,
                'route_id' => $schedule->route_id,
                'order_no' => CodeHelper::dateCode('ORD', 'orders', 'order_no'),
                'departure_city' => $schedule->route->departure_id,
                'departure_point' => $schedule->route->points->first()->point_id,
                'departure_date' => $schedule->date->format('d/m/Y'),
                'departure_time' => $schedule->route->board_points->first()->time,
                'arrival_city' => $schedule->route->arrival_id,
                'arrival_point' => $schedule->route->points ->last()->point_id,
                'arrival_date' => $schedule->date->format('d/m/Y'),
                'arrival_time' => $schedule->route->board_points->last()->time,
                'date' => date('Y-m-d H:i:s'),
                'expired_date' => date("Y-m-d H:i:s", strtotime("+2 hours")),
                'total_price' => $request->total_price,
                'status' => 'Pending',
        ]);

        // Order::create($order);

                // $order->detail()->insert([
                //     [
                //         'order_id' => $order->id, 
                //         'name' =>  ucwords($request->name), 
                //         'phone' => $request->phone, 
                //         'email' => $request->email
                //     ]
                // ]);

                // foreach($request['passenger_name'] as $key => $val) {
                //     $passengers[] = [
                //         'order_id' => $order->id,
                //         'name' => ucwords($request['passenger_name'][$key]),
                //         'nik' => $request['passenger_nik'][$key],
                //         'seat_number' => $request['passenger_seat_number'][$key],
                //         'age' => $request['passenger_age'][$key],
                //         'pax_price' => $request['passenger_pax_price'][$key],
                //         'gender' => $request['passenger_gender'][$key],
                //     ];
                // }

                // $order->passengers()->insert($passengers);
                    return $order;
                // return redirect()->route('pesan-sukses', $order->id);
                // return redirect()->route('checkout', $order->id);
    }
    
    public function sukses()
    {
        return view('pages.pesan_sukses');
    }

    public function index1(Request $request, $id)
    {
        // $item = Transaction::with(['details','travel_package','user'])->findOrFail($id);

        // return view('pages.checkout',[
        //     'item' => $item
        // ]);
    }

    public function process(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id); 

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
        ]);
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

        
        
            return redirect()->route('checkout-success', $order->id);
        // $travel_package = TravelPackage::findOrFail($id);

        // $transaction = Transaction::create([
        //     'travel_packages_id' => $id,
        //     'users_id' => Auth::user()->id,
        //     'additional_visa' => 0,
        //     'transaction_total' => $travel_package->price,
        //     'transaction_status' => 'IN_CART'
        // ]);

        // TransactionDetail::create([
        //     'transactions_id' => $transaction->id,
        //     'username' => Auth::user()->username,
        //     'nationality' => 'ID',
        //     'is_visa' => false,
        //     'doe_passport' => Carbon::now()->addYears(5)
        // ]);

        // return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        //
    }

    public function create(Request $request, $id)
    {
        //
    }

    public function success(Request $request, $id)
    {
        
        $order = Order::with([
            'schedule', 
            'route', 
            'detail', 
            'payment', 
            'passengers', 
            'departureCity', 
            'departurePoint',
            'arrivalCity',
            'arrivalPoint',
        ])->findOrFail($id);

        // dd($order->passengers[0]);

        return view('pages.pesan_sukses',[
            'order' => $order
        ]);


    }
}
