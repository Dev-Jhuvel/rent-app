<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /** @use HasFactory<\Database\Factories\HouseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'isAvailable',
        'roomCount',
        'houseRent',
        'electricRate',
        'waterRate',
    ];


    public function users()
    {
        return $this->HasMany(User::class);
    }
    // public function tenants()
    // {
    //     return $this->hasMany(Tenant::class);
    // }
}
