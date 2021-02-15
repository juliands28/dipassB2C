<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'bus_id',
        'bus_number',
        'route_id',
        'date',
        'price',
        'seat_price'
    ];

    protected $hidden = [
        'bus_id',
        'route_id',
        'seat_price',
        'created_by', 
        'updated_by', 
        'deleted_by', 
        'created_at', 
        'updated_at', 
        'deleted_at'
    ];

    protected $casts = [
        'date' => 'datetime: Y-m-d',
    ];

    // public static function boot() {
    //     parent::boot();
        
    //     static::updating(function($table) {
    //         $table->updated_by = auth()->user()->id;
    //     });

    //     static::deleting(function($table) {
    //         $table->deleted_by = auth()->user()->id;
    //         $table->save();
    //     });

    //     static::saving(function($table) {
    //         $table->created_by = auth()->user()->id;
    //         $table->updated_by = auth()->user()->id;
    //     });
    // }


    public function bus_number()
    {
        return $this->belongsTo(BusNumber::class, 'bus_number', 'bus_number');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'schedule_id','id');
    }
    
}
