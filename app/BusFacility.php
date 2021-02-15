<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusFacility extends Model
{
    public $timestamps = false;
    
    protected $table = 'bus_facilities';

    protected $fillable = [
        'bus_id',
        'facility_id'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
