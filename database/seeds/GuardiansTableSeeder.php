<?php

use Illuminate\Database\Seeder;

class GuardiansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guardians = [
            [
                'name' => 'Nana G\'Ardiannone',
                'relationship' => 'Grandmother',
                'release_form' => 'Guardian 1: RELEASE FORM TEXT',
                'program_id' => 1,
                'state_id' => 37
            ],
            [
                'name' => 'Papa G\'Ardiantu',
                'relationship' => 'Father',
                'release_form' => 'Guardian 2: RELEASE FORM TEXT',
                'program_id' => 2,
                'state_id' => 37
            ],
        ];

        foreach ($guardians as $guardian) {
            DB::table('guardians')->insert($guardian);
        }
    }
}
