<?php
namespace App\Imports;
use App\Models\Business;
use App\Models\City;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BusinessImport implements ToModel, WithHeadingRow
{
    // Méthode pour créer un modèle Business à partir d'une ligne du CSV
    public function model(array $row)
    {
        if($row["business_name"] != null) {
            // Crée ou récupère la ville associée
            $city = City::firstOrCreate(
                ['ville' => $row["city"]],
                ['region' => null]
            );
            // Crée et retourne une nouvelle instance de Business
            return new Business([
                "business_name" => $row["business_name"],
                "contact_email" => $row["contact_email"],
                "city_id"       => $city->id,
                "category"      => $row["category"] ?? null,
            ]);
        }
    }
}
