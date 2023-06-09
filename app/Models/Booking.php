<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'quantity',
        'start_date',
        'end_date',
        'status'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function usage()
    {
        return $this->hasOne(Usage::class);
    }

    protected static function newFactory()
    {
        return \Database\Factories\BookingFactory::new();
    }

    protected $primaryKey = 'id';
}
