<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model
{
    use SoftDeletes;
    
    protected $table = 'classes';

    protected $fillable = [
        'company_id', 
        'class_name',
        'created_by', 
        'updated_by', 
        'deleted_by'
    ];

    protected $hidden = [
        'created_by', 
        'updated_by', 
        'deleted_by', 
        'created_at', 
        'updated_at', 
        'deleted_at',
        'company_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public static function boot() {
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
