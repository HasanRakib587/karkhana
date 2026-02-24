<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'phone',
        'street_address',
        'location_type',
        'is_default',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
