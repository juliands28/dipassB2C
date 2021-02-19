<?php

namespace App\Http\Controllers;

use App\Order;
use App\Schedule;
use Illuminate\Http\Request;
use App\Helpers\CodeHelper;
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
    public function order(Request $request, $id)
    {
        // $order = Order::findOrFail($id);

        $order = [
                'schedule_id' => $id,
                'route_id' => $request->route_id,
                'order_no' => CodeHelper::dateCode('ORD', 'orders', 'order_no'),
                'departure_city' => $request->departure_city,
                'departure_point' => $request->departure_point,
                'departure_date' => $request->departure_date,
                'departure_time' => $request->departure_time,
                'arrival_city' => $request->arrival_city,
                'arrival_point' => $request->arrival_point,
                'arrival_date' => $request->arrival_date,
                'arrival_time' => $request->arrival_time,
                'date' => date('Y-m-d H:i:s'),
                'expired_date' => date("Y-m-d H:i:s", strtotime("+2 hours")),
                'total_price' => $request->total_price,
                'status' => 'Pending',
        ];

        Order::create($order);

                // $order->detail()->insert([
                //     [
                //         'order_id' => $order->id, 
                //         'name' =>  ucwords($request->name), 
                //         'phone' => $request->phone, 
                //         'email' => $request->email
                //     ]
                // ]);
                // // foreach ($carts as $cart) {
                // //     $trx = 'TRX-' . mt_rand(0000,9999);
        
                // //     TransactionDetail::create([
                // //         'transactions_id' => $transaction->id,
                // //         'products_id' => $cart->product->id,
                // //         'price' => $cart->product->price,
                // //         'shipping_status' => 'PENDING',
                // //         'resi' => '',
                // //         'code' => $trx
                // //     ]);

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
    }
    
    public function sukses()
    {
        return view('pages.pesan_sukses');
    }
}
