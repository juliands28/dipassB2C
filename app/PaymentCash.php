<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentCash extends Model
{
    public $timestamps = false;
    
    protected $table = 'payment_cashes';

    protected $fillable = [
        'payment_id', 
        'cash_amount',
        'return_amount',
    ];

    protected $hidden = [
        'payment_id'
    ];

    public function payment()
    {
        $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
}
