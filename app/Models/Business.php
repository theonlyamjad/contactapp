<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = ['business_name', 'contact_email', 'city_id', 'website', 'location', 'category', 'user_id'];

    // Business belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Business belongs to a city
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    // Polymorphic relationship with tags
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // Polymorphic relationship with tasks
    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable');
    }
}
