<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['ville', 'region'];
    protected $attributes = [
        'region' => null,
    ];
    public function persons()
    {
        return $this->hasMany(Person::class, 'city_id');
    }

    public function businesses()
    {
        return $this->hasMany(Business::class, 'city_id');
    }
}
