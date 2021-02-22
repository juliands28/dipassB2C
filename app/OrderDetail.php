<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    
    protected $table = 'order_details';

    protected $fillable = [
        'order_id', 
        'name',
        'phone',
        'email',
    ];

    protected $hidden = [
        'order_id'
    ];

    public function order()
    {
<<<<<<< HEAD
        $this->belongsTo(Order::class, 'order_id', 'id');
=======
        $this->belongsTo(Order::class,'order_id', 'id');
>>>>>>> 8952b1958a4d2d00925f9193ea092fa5adc1f1f3
    }
}
