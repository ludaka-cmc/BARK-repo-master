<?php

use AKCBark\Models\Studentage;
use Illuminate\Database\Seeder;

class StudentagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studentages = [
            [
                'title' => '2-5',
                'age_min' => 2,
                'age_max' => 5,
                'description' => 'Pre-school (2-5)',
            ],
            [
                'title' => '5-10',
                'age_min' => 5,
                'age_max' => 10,
                'description' => 'Elementary (5-10)',
            ],
            [
                'title' => '10-14',
                'age_min' => 10,
                'age_max' => 14,
                'description' => 'Middle (10-14)',
            ],
            [
                'title' => '14-18',
                'age_min' => 14,
                'age_max' => 18,
                'description' => 'Secondary (14-18)',
            ],
            [
                'title' => '18',
                'age_min' => 18,
                'age_max' => Studentage::MAX_AGE,
                'description' => 'Adult (18+)',
            ],
        ];

        foreach ($studentages as $studentage) {
            DB::table('studentages')->insert($studentage);
        }
    }
}
