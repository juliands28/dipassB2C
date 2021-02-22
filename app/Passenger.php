<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    public $timestamps = false;
    
    protected $table = 'passengers';
    protected $primaryKey = 'ticket_number';
    protected $keyType = 'string';

    protected $fillable = [
        'ticket_number', 
        'booking_id',
        'name',
        'nik',
        'seat_number',
        'age',
        'gender',
        'refund',
        'reschedule',
    ];

    protected $hidden = [
        'booking_id'
    ];

    public function booking()
    {
        $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
