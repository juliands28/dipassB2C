<?php

namespace App\Http\Controllers;

use App\BookingOrder;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
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
            })->get();
// dd($bookings);
        $carts = Order::with([
            'schedule', 
            'route', 
            'detail', 
            'payment', 
            'payment.upload', 
            'passengers', 
            'companies',
            'departureCity', 
            'departurePoint',
            'arrivalCity',
            'arrivalPoint',
            ])
        ->where('created_by', Auth::user()->id)
        ->where('status', '=', 'Pending')
        ->get();
        // dd($carts[0]->id);
        

        return view('pages.cart',[
            'carts' => $carts,
            'bookings' => $bookings,
        ]);
    }

    // public function delete(Request $request, $id)
    // {
    //     $cart = Cart::findOrFail($id);

    //     $cart->delete();

    //     return redirect()->route('cart');
    // }
}
