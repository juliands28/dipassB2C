<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use SoftDeletes;

    protected $table = 'buses';

    protected $fillable = [
        'category_id', 
        'class_id', 
        'bus_name', 
        'seat_count', 
        'created_by', 
        'updated_by', 
        'deleted_by'
    ];

    protected $hidden = [
        'category_id', 
        'class_id',
        'created_by', 
        'updated_by', 
        'deleted_by', 
        'created_at', 
        'updated_at', 
        'deleted_at',
        'company_id',
        'category_id',
        'pivot'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
        'layout' => 'json',
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

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function numbers()
    {
        return $this->hasMany(BusNumber::class, 'bus_number', 'bus_number');
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'bus_facilities', 'bus_id', 'facility_id');
    }
    
    public function busfacilities()
    {
        return $this->hasMany(BusFacility::class, 'bus_id', 'id');
    }
    public function buspivot()
    {
        return $this->belongsToMany(BusFacility::class)->withPivot('bus_id', 'facility_id');
        // return $this->belongsToMany(Facility::class, 'bus_facilities', 'bus_id', 'facility_id');
    }
}
