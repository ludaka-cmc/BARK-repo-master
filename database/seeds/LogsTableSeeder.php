<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_visited = Carbon::now();

        $logs = [
            [
                'user_id' => 1,
                'dog_id' => null,
                'log_usertype' => 'reader',
                'location_id' => 2,
                'studentnum_id' => 2,
                'studentage_id' => 4,
                'book_read' => 'Madeleine L\'Engle - A Wrinkle in Time',
                'hours' => 1.5,
                'pages' => 45,
                'log_date' => $date_visited
            ],
            [
                'user_id' => 1,
                'dog_id' => null,
                'log_usertype' => 'reader',
                'location_id' => 4,
                'location_other' => 'Museum',
                'studentnum_id' => 5,
                'studentage_id' => 2,
                'book_read' => 'Maurice Sendak - Where the Wild Things Are',
                'hours' => 1.25,
                'pages' => 40,
                'log_date' => $date_visited
            ],
            [
                'user_id' => 1,
                'dog_id' => 1,
                'log_usertype' => 'volunteer',
                'location_id' => 2,
                'studentnum_id' => 5,
                'studentage_id' => 2,
                'log_date' => $date_visited
            ],
        ];

        foreach ($logs as $log) {
            DB::table('logs')->insert($log);
        }
    }
}
