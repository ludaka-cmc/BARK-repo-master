<?php

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notes = [
            [
                'title' => 'Note #1 - Associated with dog_id: 1',
                'body' => 'BODY ###1',
                'dog_id' => 1,
                'student_id' => null
            ],
            [
                'title' => 'Note #2 - Associated with student_id: 1',
                'body' => 'BODY ###2',
                'dog_id' => null,
                'student_id' => 1
            ],
        ];

        foreach ($notes as $note) {
            DB::table('notes')->insert($note);
        }
    }
}
