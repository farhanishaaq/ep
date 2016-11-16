<?php
/**
 * Created by PhpStorm.
 * User: Aitzaz Wattoo
 * Date: 19-Oct-16
 * Time: 4:01 PM
 */

use Faker\Factory as Faker;

class VitalSignsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('vital_signs')->truncate();
        //1
        VitalSign::create([
            'weight' => '53',
            'height' => '5.4',
            'bp_systolic' => '120',
            'bp_diastolic' => '80',
            'blood_group' => 'O+',
            'pulse_rate' => '65',
            'respiration_rate' => '65',
            'temperature' => '98',
            'gait_speed' => '100',
            'addiction' => 'No',
            'communities' => 'Scouting',
            'note' => 'Working finely',
        ]);

        VitalSign::create([
            'weight' => '83',
            'height' => '5.4',
            'bp_systolic' => '124',
            'bp_diastolic' => '70',
            'blood_group' => 'A',
            'pulse_rate' => '75',
            'respiration_rate' => '75',
            'temperature' => '105',
            'gait_speed' => '15',
            'addiction' => 'No',
            'communities' => 'No',
            'note' => 'Injury in foot',
        ]);


    }

}