<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'status',
        'due_date',
        'note'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    protected static function newFactory()
    {
        return \Database\Factories\UsageFactory::new();
    }

    protected $primaryKey = 'id';
}
