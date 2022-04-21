<?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            ['student_id' => 1],
            ['student_id' => 2],
        ];

        foreach ($programs as $program) {
            DB::table('programs')->insert($program);
        }
    }
}
