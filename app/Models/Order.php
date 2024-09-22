<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'address_id', 'uuid', 'preference', 'api_response'];

    protected $casts = [
        'api_response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->uuid = str()->uuid();
        });
    }
}
