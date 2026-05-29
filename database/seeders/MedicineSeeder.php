<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $medicines = [
            'Paracetamol', 'Ibuprofen', 'Amoxicillin', 'Ciprofloxacin', 'Azithromycin',
            'Metformin', 'Amlodipine', 'Losartan', 'Omeprazole', 'Cetirizine',
            'Loratadine', 'Salbutamol', 'Dextromethorphan', 'Ambroxol', 'Mefenamic Acid',
            'Diclofenac', 'Hydrocortisone', 'Prednisone', 'Vitamin C', 'Vitamin D3',
            'Multivitamins', 'Calcium Carbonate', 'Ferrous Sulfate', 'Folic Acid', 'Insulin',
            'Glucose', 'Hydrochlorothiazide', 'Clindamycin', 'Metronidazole', 'Ranitidine',
            'Simvastatin', 'Atorvastatin', 'Naproxen', 'Tramadol', 'Morphine',
            'Loperamide', 'Dicyclomine', 'Buscopan', 'Cough Syrup', 'Antacid',
            'Oral Rehydration Salts', 'Zinc Sulfate', 'Eye Drops', 'Ear Drops', 'Betadine',
            'Alcohol 70%', 'Povidone Iodine', 'Nebulizer Solution', 'Saline Solution', 'Antibiotic Ointment'
        ];

        foreach ($medicines as $name) {
            Medicine::create([
                'medicine_name' => $name,
                'stock_quantity' => rand(5, 200),
                'unit' => 'tablet',
            ]);
        }
    }
}