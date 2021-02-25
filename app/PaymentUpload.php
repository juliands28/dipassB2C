<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentUpload extends Model
{
    public $timestamps = false;
    
    protected $table = 'payment_uploads';

    protected $fillable = [
        'payment_id', 
        'photos',
    ];

    protected $hidden = [
        'payment_id'
    ];

    public function payment()
    {
        $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
}
