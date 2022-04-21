<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $this->call(CertificationsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(StudentagesTableSeeder::class);
        $this->call(StudentnumsTableSeeder::class);
        $this->call(MilestonesTableSeeder::class);

        // Note: In order to avoid integrity constraint violation errors, do not change seeder order
        $this->call(TextblocksTableSeeder::class);
        $this->call(GigyaUsersTableSeeder::class);
        $this->call(VolunteersTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(DogsTableSeeder::class);
        $this->call(ProgramsTableSeeder::class);
        $this->call(GuardiansTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(BreedsTableSeeder::class);
        $this->call(LogsTableSeeder::class);
        $this->call(NotesTableSeeder::class);
    }
}
