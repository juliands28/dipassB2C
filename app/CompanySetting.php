<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    public $timestamps = false;
    
    protected $table = 'company_settings';
    protected $primaryKey = 'company_id';

    protected $fillable = [
        'company_id', 
        'key_app', 
        'key_dipass', 
        'email_mailer',
        'email_host',
        'email_port',
        'email_username',
        'email_password',
        'email_encryption',
        'email_from_address',
        'email_from_name', 
    ];

    protected $hidden = [
        'company_id', 
        'email_mailer',
        'email_host',
        'email_port',
        'email_username',
        'email_password',
        'email_encryption',
        'email_from_address',
        'email_from_name',
    ];

    protected $casts = [
        'refund_setting' => 'json',
        'reschedule_setting' => 'json',
        'marketplace_setting' => 'json',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    
}
