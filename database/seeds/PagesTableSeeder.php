<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'title' => 'homepage',
                'description' => 'Homepage - The Home Page',
                'homepage' => 1
            ],
            [
                'title' => 'readerlog',
                'description' => 'Reader Log',
                'homepage' => 0
            ],
            [
                'title' => 'readerentry',
                'description' => 'Reader Entry',
                'homepage' => 0
            ],
            [
                'title' => 'volunteerlog',
                'description' => 'Volunteer Log',
                'homepage' => 0
            ],
            [
                'title' => 'volunteerentry',
                'description' => 'Volunteer Entry',
                'homepage' => 0
            ],
            [
                'title' => 'volunteerinfo',
                'description' => 'Volunteer Info',
                'homepage' => 0
            ],
            [
                'title' => 'doginfo',
                'description' => 'Dog Info',
                'homepage' => 0
            ],
            [
                'title' => 'all',
                'description' => '*',
                'homepage' => 0
            ],
        ];

        foreach ($pages as $page) {
            DB::table('pages')->insert($page);
        }
    }
}
