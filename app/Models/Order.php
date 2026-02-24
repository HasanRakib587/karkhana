<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'grand_total',
        'payment_method',
        'bkash_last_digits',
        'bkash_trx_id',
        'confirmation_email_sent',
        'confirmation_email_sent_at',
        'payment_status',
        'transaction_reference',
        'meta',
        'status',
        'shipping_cost',
        'notes',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->hasOne(OrderAddress::class);
    }
}
