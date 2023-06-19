<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'categories_id', 
        'unit_id', 
        'name', 
        'brand', 
        'serial_number', 
        'photo', 
        'quantity', 
        'status'
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function Unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function Bookings()
    {
        return $this->hasMany(Booking::class);
    }

    protected static function newFactory()
    {
        return \Database\Factories\ItemFactory::new();
    }

    protected $primaryKey = 'id';
}
