<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'unit_id', 
        'name', 
        'brand', 
        'serial_number', 
        'photo', 
        'quantity', 
        'status',
        'description',
    ];

    public function rules()
    {
        return [
            'serial_number' => 'unique:items',
            'quantity' => function ($attribute, $value, $fail) {
                if ($this->serial_number && $value != 1) {
                    $fail('If the item has a serial number, the quantity must be 1.');
                }
            },
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    protected static function newFactory()
    {
        return \Database\Factories\ItemFactory::new();
    }

    protected $primaryKey = 'id';
}
