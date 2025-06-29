<?php

// Déclare le namespace du fichier
namespace App\Imports;

// Importe le modèle Person
use App\Models\Person;
use Maatwebsite\Excel\Concerns\ToModel;// convertir chaque ligne d'un fichier Excel en une instance d'un modèle Eloquent
use Maatwebsite\Excel\Concerns\WithHeadingRow;//la première ligne du fichier Excel contient les en-têtes de colonnes.

// Déclare la classe PersonImport qui implémente les interfaces ToModel et WithHeadingRow
class PersonImport implements ToModel, WithHeadingRow
{
    // Méthode model : convertit chaque ligne du fichier importé en une instance du modèle Person
    public function model(array $row)
    {
        // Vérifie si le champ 'firstname' n'est pas null
        if ($row["firstname"] != null) {
            // Retourne une nouvelle instance du modèle Person avec les données de la ligne
            return new Person([
                "firstname"     => $row["firstname"],
                "lastname"      => $row["lastname"],
                "email"         => $row["email"],
                "phone"         => $row["phone"],
                "business_name" => $row["business"],
                "city"          => $row["city"],
                "activity"      => $row["activity"],
                "gender"        => $row['gender'],
                "age"           => $row['age'],
            ]);
        }
    }
}

