<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status', 'user_id'];

    // Task belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Task belongs to either a person or a business
    public function taskable()
    {
        return $this->morphTo();
    }

    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->save();
        return true;
    }

    public function scopeOpen($query)
    {
        $query->where('status', 'open');
    }
}
