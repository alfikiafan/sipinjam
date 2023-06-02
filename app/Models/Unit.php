<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'location'
    ];

    public function Item()
    {
        return $this->hasMany(Item::class);
    }

    public function Administrator()
    {
        return $this->belongsToMany(Administrator::class, 'unit_admins');
    }
}
