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
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Auth;

class PaymentUploadController extends Controller
{
    public function index(Request $request, $id)
    {
        
        $order = Order::with([
            'payment',
            'payment.upload'
            ])
            ->findOrFail($id);

        return view('pages.payment',[
            'order' => $order
        ]);


    }

    public function uploadGallery(UploadRequest $request)
    {

        $data = $request->all();

        $data['date'] = date('Y-m-d');
            
        $data['photos'] = $request->file('photos')->store('assets/trasfer', 'public');

        PaymentUpload::create($data);

        // dd($data);

        return redirect()->route('payment-checkout', $request->order_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = $request->all();
        $item = PaymentUpload::findorFail($id);
        $item->delete();


        return redirect()->route('payment-checkout', $request->order_id);
    }
    
    public function process(Request $request, $id)
    {
        
        $order = Order::with('route')->where('status', '=', 'Pending')
        ->findOrFail($id);
        $user = $request->created_by;

        Payment::create([
            'created_by' => Auth::user()->id,
            'order_id' => $id,
            'payment_no' => CodeHelper::dateCode('PY', 'payments', 'payment_no'),
            'payment_amount' => $order->total_price,
            'method' => 'Transter',
            'created_by' => $user,
            ]);

    //     dd($payment);

        return redirect()->route('payment-checkout', $order->id);


    }
}
