<?php
namespace App\Models; // Déclare le namespace du modèle
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Person extends Model // Déclare la classe Person qui étend la classe Model d'Eloquent
{
    // Définit les attributs qui peuvent être assignés en masse
    protected $fillable = ['firstname', 'lastname', 'email', 'phone','business_name', 'city', 'activity', 'gender', 'age','user_id'];

    // Définit une relation polymorphique un-à-plusieurs avec le modèle Task
    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable');// Cette personne peut avoir plusieurs tâches
    }
    // Définit une relation polymorphique plusieurs-à-plusieurs avec le modèle Tag
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');// Cette personne peut avoir plusieurs tags
    }
    // Définit une relation inverse un-à-plusieurs avec le modèle City
    public function cityData()
    {
        return $this->belongsTo(City::class, 'city', 'ville');// Cette personne appartient à une ville (relation inverse)
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
