<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';

    protected $fillable = [
        'schedule_id', 
        'route_id', 
        'order_no', 
        'departure_city', 
        'departure_point',
        'departure_date',
        'departure_time',
        'arrival_city',
        'arrival_point',
        'arrival_date',
        'arrival_time',
        'boarding_date',
        'date',
        'expired_date',
        'status',
        'total_price',
    ];

    protected $hidden = [
        'schedule_id',
        'route_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at', 
        'updated_at', 
        'deleted_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s'
    ];

    // public static function boot() {
    //     parent::boot();

    //     static::updating(function($table)  {
    //         $table->updated_by = auth()->user()->id;
    //     });

    //     static::deleting(function($table) {
    //         $table->deleted_by = auth()->user()->id;
    //         $table->save();
    //     });

    //     static::saving(function($table)  {
    //         $table->created_by = auth()->user()->id;
    //         $table->updated_by = auth()->user()->id;
    //     });
    // }

    public function created_by_user()
    {
        return $this->belongsTo('App\User', 'created_by', 'id')->select(['id', 'name']);
    }

    public function updated_by_user()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id')->select(['id', 'name']);
    }

    public function deleted_by_user()
    {
        return $this->belongsTo('App\User', 'deleted_by', 'id')->select(['id', 'name']);
    }
    
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }

    public function detail()
    {
        return $this->hasOne(OrderDetail::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function passengers()
    {
        return $this->hasMany(OrderPassenger::class);
    }

    public function agents()
    {
        return $this->belongsToMany(Agent::class, 'order_agents', 'order_id', 'agent_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'order_providers', 'order_id', 'company_id');
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
}
