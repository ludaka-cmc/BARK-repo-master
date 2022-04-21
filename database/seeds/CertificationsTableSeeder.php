<?php

use Illuminate\Database\Seeder;

class CertificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certifications = [
            [
                'title' => 'CGC',
                'description' => 'AKC Canine Good Citizen (CGC)',
                'url' => 'https://www.akc.org/products-services/training-programs/canine-good-citizen/',
            ],
            [
                'title' => 'Urban CGC',
                'description' => 'AKC Urban Canine Good Citizen (CGC)',
                'url' => 'https://www.akc.org/products-services/training-programs/canine-good-citizen/akc-urban-canine-good-citizen/',
            ],
            [
                'title' => 'Therapy Dog',
                'description' => 'AKC Therapy Dog',
                'url' => 'https://www.akc.org/sports/title-recognition-program/therapy-dog-program/',
            ],
        ];

        foreach ($certifications as $certification) {
            DB::table('certifications')->insert($certification);
        }
    }
}
