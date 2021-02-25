<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public $timestamps = false;

    protected $table = 'bookings';

    protected $fillable = [
        'PNR', 
        'company_id', 
        'departure_city', 
        'departure_point', 
        'departure_date',
        'departure_time',
        'arrival_city',
        'arrival_point',
        'arrival_date',
        'arrival_time',
        'booking_date',
        'bus_number'
    ];

    protected $hidden = [
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class)->where([
            ['refund', '=', '0'],
            ['reschedule', '=', '0']
        ]);
    }

    public function departureCity()
    {
        return $this->belongsTo(City::class, 'departure_city', 'id');
    }

    public function departurePoint()
    {
        return $this->belongsTo(Point::class, 'departure_point', 'id');
    }

    public function arrivalCity()
    {
        return $this->belongsTo(City::class, 'arrival_city', 'id');
    }

    public function arrivalPoint()
    {
        return $this->belongsTo(Point::class, 'arrival_point', 'id');
    }

    public function busNumber()
    {
        return $this->belongsTo(BusNumber::class, 'bus_number', 'bus_number');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'booking_orders', 'booking_id', 'order_id');
    }
}
