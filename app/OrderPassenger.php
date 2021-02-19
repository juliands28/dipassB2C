<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DateTime;

class OrderPassenger extends Model
{
    public $timestamps = false;
    
    protected $table = 'order_passengers';

    protected $appends = ['refund_price'];

    protected $fillable = [
        'order_id', 
        'name',
        'nik',
        'seat_number',
        'age',
        'pax_price',
        'gender',
    ];

    protected $hidden = [
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function getRefundPriceAttribute()
    {
        if(auth()->guard('admin')->check()){
            $auth = auth()->guard('admin')->user()->load('admin.company.setting');
            $setting = $auth->admin->company->setting;
        }

        if(auth()->guard('agent')->check()){
            $auth = auth()->guard('agent')->user()->load('agent.company.setting');
            $setting = $auth->agent[0]->company->setting;
        }

        if($setting->refundable === '1'){
            $datetime = new DateTime(date('Y-m-d H:i:s.u'));
            $results = 100;

            $departure_date = $this->order->departure_date;
            $departure_time = $this->order->departure_time;
            $departure_datetime = new DateTime(date('Y-m-d H:i:s.u', strtotime("$departure_date $departure_time")));

            $interval = $datetime->diff($departure_datetime);

            $total_days = $interval->days * 24 * 60 * 60 * 1000;
            $total_hours = $interval->h * 60 * 60 * 1000;
            $total_minuets = $interval->i * 60 * 1000;
            $total_seconds =$interval->s * 1000;

            $diff = $total_days + $total_hours + $total_minuets + $total_seconds;

            foreach($setting->refund_setting as $key){
                $greater_than = $key['greater_than'] !== null ? $key['greater_than'] * 60 * 60 * 1000 : 'INF';
                $lower_than = $key['lower_than'] !== null ? $key['lower_than'] * 60 * 60 * 1000 : 'INF';

                if($greater_than !== 'INF' && $lower_than !== 'INF'){
                    if(($diff >= $greater_than) && ($diff < $lower_than)){
                        $results = $key['percentage'];
                    }
                } else if ($greater_than === 'INF' && $lower_than !== 'INF') {
                    if(($diff < $lower_than)){
                        $results = $key['percentage'];
                    }
                } else if($greater_than !== 'INF' && $lower_than === 'INF') {
                    if(($diff >= $greater_than)){
                        $results = $key['percentage'];
                    }
                } else {
                    $results = 100;
                }
            }

            return ($this->attributes['pax_price'] * $results) / 100;
        } else {
            return null;
        }
    }
}
