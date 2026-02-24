<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Customer extends Authenticatable
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'google_id',
        'facebook_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    protected static function booted()
    {
        static::creating(function ($customer) {
            if (! $customer->password) {
                $customer->password = \Illuminate\Support\Facades\Hash::make(Str::random(12));
            }
        });
    }
}
