<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingOrder;
use App\Helpers\CodeHelper;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class ManifestController extends Controller
{
    public function index(Request $request, $id)
    {
        $booking = Booking::with([
            'orders',
            'busNumber',
            'busNumber.bus',
        ])->findOrFail($id);

        return view('pages.mainfest',[
            'booking' => $booking
        ]);
    }

    public function process(Request $request, $id)
    {
        $order = Order::with('route')->where('status', '=', 'Success')
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

    public function sukses(Request $request, $id)
    {
        $bookings = BookingOrder::with([
            'booking',
            'order',
            'order.route', 
            'order.schedule', 
            'order.detail', 
            'order.payment', 
            'order.payment.upload', 
            'order.passengers', 
            'order.companies',
            'order.departureCity', 
            'order.departurePoint',
            'order.arrivalCity',
            'order.arrivalPoint',
            ])
            ->whereHas('order', function($order){
                $order->where('created_by', Auth::user()->id);
            })->take(1)->get();
            // dd($bookings);
            
        $order = Order::with('route')
        // ->where('status', '=', 'Success')
        ->findOrFail($id);
        
        return view('pages.sukses',[
            'order' => $order,
            'bookings' => $bookings,
        ]);
    }

    public function pdf(Request $request, $id)
    {
        $booking = Booking::with([
            'orders',
            'busNumber',
            'busNumber.bus',
        ])->findOrFail($id);

        // return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pages.mainfest-print',['booking'=>$booking])->stream();

        $pdf = PDF::loadview('pages.mainfest-print',['booking'=>$booking])->setPaper('a4');

        return $pdf->download('mainfest-tiket.pdf');

        // return view('pages.mainfest-print',compact('booking'));
    }

    public function print()
    {
        // $booking = Booking::with([
        //     'orders',
        //     'busNumber',
        //     'busNumber.bus',
        // ])->findOrFail($id);

        // $pdf = PDF::loadview('pages.mainfest-print')->setPaper('A4','potrait');

        return view('pages.mainfest-print',[
            // 'order' => $order,
            // 'bookings' => $bookings,
        ]);
    }
}
