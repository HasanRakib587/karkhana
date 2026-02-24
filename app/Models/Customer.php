<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
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
