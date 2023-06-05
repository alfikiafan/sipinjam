<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id', 
        'user_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory()
    {
        return \Database\Factories\UnitAdminFactory::new();
    }

    protected $primaryKey = 'id';
}
