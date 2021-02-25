<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingOrder;
use App\Helpers\CodeHelper;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManifestController extends Controller
{
    public function index(Request $request, $id)
    {
        $booking = Booking::with([
            'orders',
            'busNumber',
            'busNumber.bus',
        ])->findOrFail($id);

        // dd($booking->orders);


        return view('pages.mainfest',[
            'booking' => $booking
        ]);
    }

    public function process(Request $request, $id)
    {
        $order = Order::with('route')->where('status', '=', 'Pending')
        ->findOrFail($id);

            $booking = Booking::create([
                'PNR' => Str::random(10),
            'company_id' => $order->route->company_id,
            'departure_city' => $order->departure_city,
            'departure_point' => $order->departure_point,
            'departure_date' => $order->departure_date,
            'departure_time' => $order->departure_time,
            'arrival_city' => $order->arrival_city,
            'arrival_point' => $order->arrival_point,
            'arrival_date' => $order->arrival_date,
            'arrival_time' => $order->arrival_time,
            'bus_number' => $order->schedule->bus_number,
            'booking_date' => date('Y-m-d H:i:s'),]);

            $booking_order = new BookingOrder;
                
            $booking_order->booking_id = $booking->id;
            $booking_order->order_id = $order->id;

            $booking_order->save();

            foreach($order->passengers as $passenger) {
                $passengers[] = [
                    'ticket_number' => date('Ymd').'-'.$booking->PNR.'-'.Str::random(5),
                    'booking_id' => $booking->id,
                    'name' => $passenger->name, 
                    'nik' => $passenger->nik,
                    'seat_number' => $passenger->seat_number,
                    'age' => $passenger->age,
                    'gender' => $passenger->gender,
                ];
            }

            $booking->passengers()->insert($passengers);

    // $payment_upload = new PaymentUpload;
                
    //             $payment_upload->'payment_id' = $payment->id;
    //             $payment_upload->'photo' = $request->file('photo')->store('assets/upload-transfer', 'public');

    //             $payment_upload->save();

    //     dd($payment);

        return redirect()->route('manifest', $booking->id);

            
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
