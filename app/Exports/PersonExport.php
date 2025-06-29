<?php

namespace App\Exports;// Déclare le namespace du fichier
use App\Models\Person;// Importe le modèle Person
// Importe les interfaces FromCollection et WithHeadings de la bibliothèque Maatwebsite Excel
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

// Déclare la classe PersonExport qui implémente les interfaces FromCollection et WithHeadings
class PersonExport implements FromCollection, WithHeadings
{
    // Méthode collection : récupère les données à exporter sous forme de collection
    public function collection()
    {
        // Sélectionne les colonnes spécifiées de la table persons et retourne les résultats sous forme de collection
        return Person::select('firstname', 'lastname', 'email', 'phone', 'business_name', 'city', 'activity', 'gender', 'age')->get();
    }

    // Méthode headings : définit les en-têtes des colonnes pour l'exportation
    public function headings(): array
    {
        // Retourne un tableau d'en-têtes correspondant aux colonnes sélectionnées
        return ['First Name','Last Name','Email','Phone','Business Name','City','Activity','Gender','Age'];
    }
}
