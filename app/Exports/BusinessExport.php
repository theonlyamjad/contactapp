<?php
namespace App\Exports;
use App\Models\Business;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BusinessExport implements FromCollection,WithHeadings
{
    // Récupère la collection de données à exporter
    public function collection()
    {
        return Business::all(['business_name', 'contact_email','category','city_id','website','location']);
    }
    // Définit les en-têtes pour le fichier CSV
    public function headings(): array
    {
        return [
            'Business Name',
            'Contact Email',
            'category',
            'city',
            'website',
            'location'
        ];
    }
}
