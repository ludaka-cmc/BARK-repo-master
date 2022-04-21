<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            [
                'title' => 'home',
                'description' => 'Home',

            ],
            [
                'title' => 'school',
                'description' => 'School',

            ],
            [
                'title' => 'community_center',
                'description' => 'Community Center',

            ],
            [
                'title' => 'other',
                'description' => 'Other',

            ],
        ];

        foreach ($locations as $location) {
            DB::table('locations')->insert($location);
        }
    }
}
