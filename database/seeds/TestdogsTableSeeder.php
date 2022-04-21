<?php

Use Carbon\Carbon;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Log;

class TestdogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dogs = [
            [
                'owner' => 'Fred Barkington',
                'name' => 'Spike',
                'state' => 'NY'
            ],
            [
                'owner' => 'Stacey Reader',
                'name' => 'Amber',
                'state' => 'NJ'
            ],
            [
                'owner' => 'Marko Polo',
                'name' => 'Toto',
                'state' => 'FL'
            ],
            [
                'owner' => 'Ozzy Mandius',
                'name' => 'Teddy',
                'state' => 'NY'
            ],
            [
                'owner' => 'Jack Tableton',
                'name' => 'Spot',
                'state' => 'TX'
            ]
        ];

        foreach ($dogs as $dog) {
            $insert_params = array_merge(
                $dog,
                [
                    'breed' => rand(1, 120),
                    'reg_number' => strtolower(str_random(5)),
                    'certifications' => null,
                    'status' => 'active',
                    'created_at' => Carbon::yesterday(),
                    'updated_at' => Carbon::yesterday(),
                ]);
        }
    }
}
