<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PotholeReport;
use App\Models\Location;

class PotholeReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = Location::all();
        
        if ($locations->isEmpty()) {
            return;
        }

        $reports = [
            ['street_name' => 'Wetstraat', 'severity' => 2, 'status' => 'reported', 'description' => 'Small crack near the crossing.'],
            ['street_name' => 'Meir', 'severity' => 4, 'status' => 'reported', 'description' => 'Large pothole in the middle of the road.'],
            ['street_name' => 'Veldstraat', 'severity' => 5, 'status' => 'reported', 'description' => 'Dangerous sinkhole, needs immediate attention!'],
            ['street_name' => 'Rue de Bruxelles', 'severity' => 1, 'status' => 'fixed', 'description' => 'Was small, already patched.'],
            ['street_name' => 'Europalaan', 'severity' => 3, 'status' => 'reported', 'description' => 'Getting worse with the rain.'],
        ];

        foreach ($reports as $report) {
            // Assign a random existing location to each report
            $report['location_id'] = $locations->random()->id;
            PotholeReport::create($report);
        }
    }
}
