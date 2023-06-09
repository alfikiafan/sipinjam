<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 
        'location',
        'description',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected static function newFactory()
    {
        return \Database\Factories\UnitFactory::new();
    }

    protected $primaryKey = 'id';
}
