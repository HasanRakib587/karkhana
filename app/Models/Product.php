<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'collection_id',
        'name',
        'slug',
        'images',
        'description',
        'price',
        'stock_quantity',
        'in_stock',
        'is_active',
        'is_featured',
        'on_sale',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
