<?php


class MedicineLocationsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('medicine_locations')->truncate();
        //1
        MedicineLocation::create([
            'name' => 'R1B1',
            'description' => 'Rack no 1 Box no 1'
        ]);

        //2

        MedicineLocation::create([
            'name' => 'R1B2',
            'description' => 'Rack no 1 Box no 2'
        ]);
        //3

        MedicineLocation::create([
            'name' => 'R2B3',
            'description' => 'Rack no 2 Box no 2'
        ]);
    }

}