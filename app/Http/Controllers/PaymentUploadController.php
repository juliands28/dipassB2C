<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingOrder;
use App\Helpers\CodeHelper;
use App\Order;
use App\Payment;
use App\PaymentUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaymentUploadController extends Controller
{
    public function index(Request $request, $id)
    {
        
        $order = Order::with([
            'payment',
            'payment.upload',
            // 'order',
            
            ])
            ->findOrFail($id);

        // dd($order);

        return view('pages.payment',[
            'order' => $order
        ]);


    }

    public function uploadGallery(Request $request)
    {
        // $order = Order::with(['payment'])->where('status', '=', 'Pending')
        // ->findOrFail($id);

        // Payment::create([
        //     'order_id' => $order->payment->payment_id,
        //     'payment_no' => CodeHelper::dateCode('PY', 'payments', 'payment_no'),
        //     'payment_amount' => $order->total_price,
        //     'method' => 'Transter'
        //     ]);

        $data = $request->all();

        $data['date'] = date('Y-m-d');
            
        $data['photos'] = $request->file('photos')->store('assets/trasfer', 'public');

        PaymentUpload::create($data);

        // dd($data);

        return redirect()->route('payment-checkout', $request->order_id);
    }

    // public function deleteGallery(Request $request, $id)
    // {
    //     $item = PaymentUpload::findorFail($id);
    //     $item->delete();

    //     return redirect()->route('payment-checkout', $payment->payment_id);
    // }
    
    public function process(Request $request, $id)
    {
        
        $order = Order::with('route')->where('status', '=', 'Pending')
        ->findOrFail($id);

        Payment::create([
            'order_id' => $id,
            'payment_no' => CodeHelper::dateCode('PY', 'payments', 'payment_no'),
            'payment_amount' => $order->total_price,
            'method' => 'Transter'
            ]);

            // $booking = Booking::create([
            //     'PNR' => Str::random(10),
            // 'company_id' => $order->route->company_id,
            // 'departure_city' => $order->departure_city,
            // 'departure_point' => $order->departure_point,
            // 'departure_date' => $order->departure_date,
            // 'departure_time' => $order->departure_time,
            // 'arrival_city' => $order->arrival_city,
            // 'arrival_point' => $order->arrival_point,
            // 'arrival_date' => $order->arrival_date,
            // 'arrival_time' => $order->arrival_time,
            // 'bus_number' => $order->schedule->bus_number,
            // 'booking_date' => date('Y-m-d H:i:s'),]);

            // $booking_order = new BookingOrder;
                
            // $booking_order->booking_id = $booking->id;
            // $booking_order->order_id = $order->id;

            // $booking_order->save();

            // foreach($order->passengers as $passenger) {
            //     $passengers[] = [
            //         'ticket_number' => date('Ymd').'-'.$booking->PNR.'-'.Str::random(5),
            //         'booking_id' => $booking->id,
            //         'name' => $passenger->name, 
            //         'nik' => $passenger->nik,
            //         'seat_number' => $passenger->seat_number,
            //         'age' => $passenger->age,
            //         'gender' => $passenger->gender,
            //     ];
            // }

            // $booking->passengers()->insert($passengers);

    // $payment_upload = new PaymentUpload;
                
    //             $payment_upload->'payment_id' = $payment->id;
    //             $payment_upload->'photo' = $request->file('photo')->store('assets/upload-transfer', 'public');

    //             $payment_upload->save();

    //     dd($payment);

        return redirect()->route('payment-checkout', $order->id);


    }


    public function booking(Request $request, $id)
    {
        
    //     $order = Order::with('route')->where('status', '=', 'Pending')
    //     ->findOrFail($id);

    //         $booking = Booking::create([
    //             'PNR' => Str::random(10),
    //         'company_id' => $order->route->company_id,
    //         'departure_city' => $order->departure_city,
    //         'departure_point' => $order->departure_point,
    //         'departure_date' => $order->departure_date,
    //         'departure_time' => $order->departure_time,
    //         'arrival_city' => $order->arrival_city,
    //         'arrival_point' => $order->arrival_point,
    //         'arrival_date' => $order->arrival_date,
    //         'arrival_time' => $order->arrival_time,
    //         'bus_number' => $order->schedule->bus_number,
    //         'booking_date' => date('Y-m-d H:i:s'),]);

    //         $booking_order = new BookingOrder;
                
    //         $booking_order->booking_id = $booking->id;
    //         $booking_order->order_id = $order->id;

    //         $booking_order->save();

    //         foreach($order->passengers as $passenger) {
    //             $passengers[] = [
    //                 'ticket_number' => date('Ymd').'-'.$booking->PNR.'-'.Str::random(5),
    //                 'booking_id' => $booking->id,
    //                 'name' => $passenger->name, 
    //                 'nik' => $passenger->nik,
    //                 'seat_number' => $passenger->seat_number,
    //                 'age' => $passenger->age,
    //                 'gender' => $passenger->gender,
    //             ];
    //         }

    //         $booking->passengers()->insert($passengers);

    // // $payment_upload = new PaymentUpload;
                
    // //             $payment_upload->'payment_id' = $payment->id;
    // //             $payment_upload->'photo' = $request->file('photo')->store('assets/upload-transfer', 'public');

    // //             $payment_upload->save();

    // //     dd($payment);

    //     return redirect()->route('payment-checkout', $order->id);


    }
}
