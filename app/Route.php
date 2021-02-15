<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'company_id',
        'bus_id',
        'arrival_id', 
        'departure_id', 
        'title', 
        'description', 
        'active', 
        'created_by', 
        'updated_by', 
        'deleted_by'
    ];

    protected $hidden = [
        'bus_id', 
        'arrival_id', 
        'departure_id',
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

    // public static function boot()
    // {
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function arrival()
    {
        return $this->belongsTo(City::class, 'arrival_id', 'id');
    }

    public function departure()
    {
        return $this->belongsTo(City::class, 'departure_id', 'id');
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

    public function board_points()
    {
        return $this->hasMany(BoardPoint::class, 'route_id', 'id');
    }

    public function points()
    {
        return $this->belongsToMany(Point::class, 'board_points')->withPivot('day', 'time', 'index', 'pickup_point', 'drop_point');
    }

    
}
