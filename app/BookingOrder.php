<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingOrder extends Model
{
    public $timestamps = false;
    
    protected $table = 'booking_orders';

    protected $fillable = [
        'booking_id', 
        'order_id',
    ];

    protected $hidden = [
        'pivot'
    ];

    public function booking()
    {
        $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function order()
    {
        $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
