<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OAuthConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'client_id',
        'client_secret',
        'additional_settings',
    ];

    protected $casts = [
        'additional_settings' => 'array',
    ];

    public static function getConfig($serviceName)
    {
        return self::where('service_name', $serviceName)->first();
    }
}