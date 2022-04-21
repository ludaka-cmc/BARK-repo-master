<?php

use Illuminate\Database\Seeder;

class DogsTableSeeder extends Seeder
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
                'name' => 'Spike',
                'breed' => 'Boston Terrier',
                'media_id' => null,
                'volunteer_id' => 1,
                'registration_number' => strtolower(str_random(12)),
                'active' => true
            ],
            [
                'name' => 'Hudson',
                'breed' => 'French Bulldog',
                'media_id' => 1,
                'volunteer_id' => 1,
                'registration_number' => null,
                'active' => true
            ],
            [
                'name' => 'Affion',
                'breed' => 'Affenpinscher',
                'media_id' => null,
                'volunteer_id' => 2,
                'registration_number' => null,
                'active' => true
            ],
        ];

        foreach ($dogs as $dog) {
            DB::table('dogs')->insert($dog);
        }
    }
}
