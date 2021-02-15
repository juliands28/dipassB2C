<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardPoint extends Model
{
    public $timestamps = false;
    
    protected $table = 'board_points';

    protected $fillable = [
        'route_id', 
        'point_id', 
        'time', 
        'day', 
        'index',
    ];

    protected $hidden = [
        'route_id', 
        'point_id',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }

    public function point()
    {
        return $this->belongsTo(Point::class, 'point_id','id');
    }
}
