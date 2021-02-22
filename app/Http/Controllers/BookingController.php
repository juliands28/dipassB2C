<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Helpers\CodeHelper;

class BookingController extends Controller
{
    public function order(Request $request)
    {
        $order = new Order;

        $order->schedule_id = $request->schedule_id;
        $order->route_id = $request->route_id;
        $order->order_no = CodeHelper::dateCode('ORD', 'orders', 'order_no');
        $order->departure_city = $request->departure_city;
        $order->departure_point = $request->departure_point;
        $order->departure_date = $request->departure_date;
        $order->departure_time = $request->departure_time;
        $order->arrival_city = $request->arrival_city;
        $order->arrival_point = $request->arrival_point;
        $order->arrival_date = $request->arrival_date;
        $order->arrival_time = $request->arrival_time;
        $order->date = date('Y-m-d H:i:s');
        $order->expired_date = date("Y-m-d H:i:s", strtotime("+2 hours"));
        $order->total_price = $request->total_price;
        $order->status = 'Pending';

        $order->save();

        $order->detail()->insert([
            [
                'order_id' => $order->id, 
                'name' =>  ucwords($request->name), 
                'phone' => $request->phone, 
                'email' => $request->email
            ]
        ]);

        foreach($request['passenger_name'] as $key => $val) {
            $passengers[] = [
                'order_id' => $order->id,
                'name' => ucwords($request['passenger_name'][$key]),
                'nik' => $request['passenger_nik'][$key],
                'seat_number' => $request['passenger_seat_number'][$key],
                'age' => $request['passenger_age'][$key],
                'pax_price' => $request['passenger_pax_price'][$key],
                'gender' => $request['passenger_gender'][$key],
            ];
        }

        $order->passengers()->insert($passengers);

    }
}
