<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'unit_admins');
    }

    protected static function newFactory()
    {
        return \Database\Factories\AdministratorFactory::new();
    }

    protected $primaryKey = 'id';
}
