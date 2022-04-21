<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [
            [
                'user_id' => 2,
                'guardian_id' => 1,
                'state_id' => 37,
                'name' => 'Student #1',
                'age' => 12,
                'email' => 'student_1@akc.org',
                'address' => '101 Park Ave.',
                'status' => true
            ],
            [
                'user_id' => 3,
                'guardian_id' => 2,
                'state_id' => 37,
                'name' => 'Student #2',
                'age' => 13,
                'email' => 'student_2@akc.org',
                'address' => '101 Park Ave.',
                'status' => true
            ],
        ];

        foreach ($students as $student) {
            DB::table('students')->insert($student);
        }
    }
}
