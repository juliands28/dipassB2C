<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{
    public $timestamps = false;
    
    protected $table = 'payment_cards';

    protected $fillable = [
        'payment_id', 
        'type',
        'card_number',
        'bank',
        'approval_code',
    ];

    protected $hidden = [
        'payment_id'
    ];

    public function payment()
    {
        $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
}
