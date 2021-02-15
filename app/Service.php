<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;
    protected $table = 'services';
    
    protected $fillable = [
        'schedule_id', 
        'pickup_id', 
        'dropping_id', 
        'active', 
        'price',
        'seat_price'
    ];

    protected $hidden = [
        'schedule_id', 
        'pickup_id', 
        'dropping_id',
    ];

    protected $casts = [
        'seat_price' => 'json',
    ];

    public function pickup()
    {
        return $this->belongsTo(Point::class, 'pickup_id', 'id');
    }

    public function dropping()
    {
        return $this->belongsTo(Point::class, 'dropping_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }
}
