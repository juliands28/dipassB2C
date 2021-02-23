<?php

namespace App\Http\Controllers;

use App\Helpers\CodeHelper;
use App\Order;
use App\Payment;
use App\PaymentUpload;
use Illuminate\Http\Request;

class PaymentUploadController extends Controller
{
    public function index(Request $request, $id)
    {
        
        $payment = Payment::with([
            'upload',
            
            ])
            ->findOrFail($id);

        // dd($payment);

        return view('pages.payment',[
            'payment' => $payment
        ]);


    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/trasfer', 'public');

        PaymentUpload::create($data);

        return redirect()->route('payment-checkout', $request->payment_id);
    }

    // public function deleteGallery(Request $request, $id)
    // {
    //     $item = PaymentUpload::findorFail($id);
    //     $item->delete();

    //     return redirect()->route('payment-checkout', $payment->payment_id);
    // }
    
    public function process(Request $request, $id)
    {
        
        $order = Order::where('status', '=', 'Pending')
        ->findOrFail($id);

        $payment = Payment::create([
            'order_id' => $id,
            'payment_no' => CodeHelper::dateCode('PY', 'payments', 'payment_no'),
            'payment_amount' => $order->total_price,
            'method' => 'Transter'
            ]);

    // $payment_upload = new PaymentUpload;
                
    //             $payment_upload->'payment_id' = $payment->id;
    //             $payment_upload->'photo' = $request->file('photo')->store('assets/upload-transfer', 'public');

    //             $payment_upload->save();

    //     dd($payment);

        return redirect()->route('payment-checkout', $payment->id);


    }
}
