<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class Agent extends Model
{
    //
=======
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use SoftDeletes;

    protected $table = 'agents';

    protected $fillable = [
        'city_id', 
        'company_id', 
        'agent_name', 
        'address', 
        'phone', 
        'pic', 
        'bank', 
        'bank_account', 
        'account_name', 
        'created_by', 
        'updated_by', 
        'deleted_by'
    ];

    protected $hidden = [
        'city_id', 
        'company_id', 
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

    public static function boot()
    {
        parent::boot();
        static::updating(function($table) {
            $table->updated_by = auth()->user()->id;
        });

        static::deleting(function($table) {
            $table->deleted_by = auth()->user()->id;
            $table->save();
        });

        static::saving(function($table) {
            $table->created_by = auth()->user()->id;
            $table->updated_by = auth()->user()->id;
        });
    }

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
        return $this->belongsTo('App\City');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function setting()
    {
        return $this->hasOne('App\AgentSetting');
    }

    public function user()
    {
        return $this->belongsToMany('App\AgentUser', 'user_agents');
    }
>>>>>>> 8952b1958a4d2d00925f9193ea092fa5adc1f1f3
}
