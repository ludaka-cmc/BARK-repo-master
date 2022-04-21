<?php

use AKCBark\Models\Studentnum;
use Illuminate\Database\Seeder;

class StudentnumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studentnums = [
            [
                'title' => '1-4',
                'description' => '1-4',
                'num_min' => 1,
                'num_max' => 4,
            ],
            [
                'title' => '5-9',
                'description' => '5-9',
                'num_min' => 5,
                'num_max' => 9,
            ],
            [
                'title' => '10-14',
                'description' => '10-14',
                'num_min' => 10,
                'num_max' => 14,
            ],
            [
                'title' => '15-19',
                'description' => '15-19',
                'num_min' => 15,
                'num_max' => 19,
            ],
            [
                'title' => '20',
                'description' => '20+',
                'num_min' => 20,
                'num_max' => Studentnum::MAX_NUM,
            ]
        ];

        foreach ($studentnums as $studentnum) {
            DB::table('studentnums')->insert($studentnum);
        }
    }
}
