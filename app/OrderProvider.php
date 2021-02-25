<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProvider extends Model
{
    public $timestamps = false;
    
    protected $table = 'order_providers';

    protected $fillable = [
        'order_id', 
        'company_id',
    ];

    protected $hidden = [
        'pivot'
    ];

    public function order()
    {
        $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function company()
    {
        $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
