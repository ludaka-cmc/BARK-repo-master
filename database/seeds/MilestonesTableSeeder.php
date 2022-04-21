<?php

use Illuminate\Database\Seeder;

class MilestonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $milestones = [
            [
                'title' => 'bookmark',
                'description' => 'Bookmark',
                'num_hours' => 5
            ],
            [
                'title' => 'certificate',
                'description' => 'Certificate',
                'num_hours' => 10
            ],
            [
                'title' => 'pencil',
                'description' => 'Pencil & Bone Eraser',
                'num_hours' => 15
            ],
            [
                'title' => 'bracelet',
                'description' => 'Rubber Bracelet',
                'num_hours' => 20
            ],
            [
                'title' => 'notebook',
                'description' => 'Notebook',
                'num_hours' => 25
            ],
            [
                'title' => 'water_bottle',
                'description' => 'Water Bottle',
                'num_hours' => 50
            ],
            [
                'title' => 'book_light',
                'description' => 'Book Light',
                'num_hours' => 75
            ],
            [
                'title' => 'shirt',
                'description' => 'T-Shirt',
                'num_hours' => 100
            ],
            [
                'title' => 'bag',
                'description' => 'Drawstring Bag',
                'num_hours' => 150
            ],
            [
                'title' => 'book',
                'description' => 'Age/Grade Level Appropriate Book About Dogs',
                'num_hours' => 200
            ],
            [
                'title' => 'raffle_25',
                'description' => 'Raffle for $25 Visa GC',
                'num_hours' => 250
            ],
            [
                'title' => 'raffle_50',
                'description' => 'Raffle for $50 Visa GC',
                'num_hours' => 300
            ],
            [
                'title' => 'ipad',
                'description' => 'Raffle for iPad',
                'num_hours' => 350
            ],
        ];

        foreach ($milestones as $milestone) {
            DB::table('milestones')->insert($milestone);
        }
    }
}
