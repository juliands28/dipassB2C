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
        $this->belongsTo(Order::class,'order_id', 'id');
    }
}
