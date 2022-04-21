<?php

use Illuminate\Database\Seeder;

class VolunteersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $volunteers = [
            [
                'user_id' => 1,
                'address' => '101 Park Ave.',
                'state_id' => 37,
                'city' => 'New York',
                'zip_code' => '10007',
                'affiliated_program' => 'n/a'
            ],
            [
                'user_id' => 2,
                'address' => '101 Park Ave.',
                'state_id' => 37,
                'city' => 'New York',
                'zip_code' => '10007',
                'affiliated_program' => 'n/a'
            ]
        ];

        foreach ($volunteers as $volunteer) {
            DB::table('volunteers')->insert($volunteer);
        }
    }
}
