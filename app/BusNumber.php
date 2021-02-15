<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusNumber extends Model
{
    public $timestamps = false;
    
    protected $table = 'bus_numbers';
    protected $primaryKey = 'bus_number';
    protected $keyType = 'string';

    protected $fillable = [
        'bus_number', 
        'bus_id', 
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
        'deleted_at'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }
}
