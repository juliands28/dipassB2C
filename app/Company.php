<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    
    protected $table = 'companies';

    protected $fillable = [
        'city_id',  
        'company_name', 
        'address', 
        'phone', 
        'email', 
        'fax',
        'npwp',
        'owner',
        'logo',
        'favicon',
    ];

    protected $hidden = [
        'city_id',
        'created_by', 
        'updated_by', 
        'deleted_by', 
        'created_at', 
        'updated_at', 
        'deleted_at',
        'pivot'
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

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function setting()
    {
        return $this->hasOne('App\CompanySetting');
    }
}
