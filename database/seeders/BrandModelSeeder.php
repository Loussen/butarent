<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Database\Seeder;

class BrandModelSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = [
            'Toyota' => ['Camry', 'Corolla', 'RAV4', 'Land Cruiser', 'Hilux', 'Yaris', 'Prius', 'Highlander', 'C-HR', 'Avalon'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'HR-V', 'Pilot', 'City', 'Odyssey', 'Passport', 'Ridgeline'],
            'Ford' => ['Mustang', 'Focus', 'Explorer', 'F-150', 'Escape', 'Edge', 'Fusion', 'Ranger', 'Bronco', 'EcoSport'],
            'BMW' => ['X5', 'X3', 'X1', 'X6', '3 Series', '5 Series', '7 Series', 'X7', 'i4', 'iX'],
            'Mercedes-Benz' => ['E-Class', 'C-Class', 'A-Class', 'S-Class', 'GLC', 'GLE', 'GLA', 'CLA', 'G-Class', 'V-Class'],
            'Chevrolet' => ['Malibu', 'Camaro', 'Tahoe', 'Cruze', 'Equinox', 'Traverse', 'Silverado', 'Spark', 'Trax', 'Blazer'],
            'Audi' => ['A4', 'A6', 'A3', 'A8', 'Q5', 'Q7', 'Q3', 'Q8', 'e-tron', 'TT'],
            'Nissan' => ['Altima', 'Sentra', 'Qashqai', 'X-Trail', 'Patrol', 'Navara', 'Juke', 'Leaf', 'Maxima', 'Pathfinder'],
            'Hyundai' => ['Sonata', 'Tucson', 'Elantra', 'Santa Fe', 'Creta', 'Accent', 'Kona', 'Palisade', 'Ioniq 5', 'Venue'],
            'Kia' => ['Optima', 'Sportage', 'Sorento', 'Cerato', 'Rio', 'Seltos', 'Carnival', 'Stinger', 'EV6', 'Picanto'],
            'Volkswagen' => ['Golf', 'Passat', 'Tiguan', 'Polo', 'Jetta', 'Touareg', 'Arteon', 'ID.4', 'T-Roc', 'Caddy'],
            'Subaru' => ['Impreza', 'Outback', 'Forester', 'XV', 'Legacy', 'WRX', 'Ascent', 'BRZ'],
            'Tesla' => ['Model 3', 'Model Y', 'Model S', 'Model X', 'Cybertruck'],
            'Jaguar' => ['F-Type', 'XE', 'XF', 'F-Pace', 'E-Pace', 'I-Pace'],
            'Lexus' => ['RX 350', 'NX 350', 'ES 350', 'LX 600', 'UX 250h', 'GX 550', 'IS 350', 'LS 500'],
            'Volvo' => ['XC60', 'XC90', 'XC40', 'S60', 'S90', 'V60', 'C40'],
            'Porsche' => ['911 Carrera', 'Cayenne', 'Macan', 'Panamera', 'Taycan', '718 Cayman', '718 Boxster'],
            'Mitsubishi' => ['Outlander', 'ASX', 'Lancer', 'Pajero', 'Eclipse Cross', 'L200', 'Mirage'],
            'Land Rover' => ['Range Rover Sport', 'Range Rover', 'Discovery', 'Defender', 'Evoque', 'Velar'],
            'GMC' => ['Sierra 1500', 'Yukon', 'Terrain', 'Acadia', 'Canyon', 'Hummer EV'],
            'Fiat' => ['500', 'Panda', 'Tipo', 'Doblo', '500X', 'Egea'],
            'Mini' => ['Cooper', 'Countryman', 'Clubman', 'Convertible', 'Paceman'],
            'Jeep' => ['Wrangler', 'Grand Cherokee', 'Cherokee', 'Compass', 'Renegade', 'Gladiator'],
            'Mazda' => ['CX-5', 'CX-30', 'CX-9', 'Mazda3', 'Mazda6', 'MX-5', 'CX-60'],
            'Peugeot' => ['208', '308', '3008', '5008', '2008', '508', 'Partner'],
            'Renault' => ['Clio', 'Megane', 'Duster', 'Captur', 'Kadjar', 'Talisman', 'Arkana', 'Symbol'],
            'Skoda' => ['Octavia', 'Superb', 'Kodiaq', 'Kamiq', 'Karoq', 'Fabia', 'Rapid'],
            'Opel' => ['Astra', 'Corsa', 'Insignia', 'Mokka', 'Crossland', 'Grandland'],
            'Suzuki' => ['Swift', 'Vitara', 'Jimny', 'SX4', 'Baleno', 'S-Cross', 'Alto'],
            'BYD' => ['Atto 3', 'Seal', 'Dolphin', 'Han', 'Tang', 'Song Plus'],
            'Changan' => ['CS35 Plus', 'CS55 Plus', 'UNI-T', 'UNI-V', 'Alsvin', 'Hunter'],
            'Haval' => ['Jolion', 'H6', 'Dargo', 'F7', 'H9'],
            'Geely' => ['Coolray', 'Monjaro', 'Preface', 'Atlas', 'Emgrand'],
            'Chery' => ['Tiggo 4', 'Tiggo 7 Pro', 'Tiggo 8 Pro', 'Arrizo 8', 'Omoda 5'],
        ];

        foreach ($catalog as $brandName => $models) {
            $brand = Brand::firstOrCreate(['name' => $brandName]);

            foreach ($models as $modelName) {
                CarModel::firstOrCreate([
                    'brand_id' => $brand->id,
                    'name' => $modelName,
                ]);
            }
        }
    }
}
