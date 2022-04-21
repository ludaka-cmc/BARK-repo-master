<?php

use AKCBark\Models\Media;
use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $media = [
            [
                'user_id' => 1,
                'name' => '1551803547_6167_6848.jpg',
                'file' => '/tmp/phpd9Y17h',
                'type' => Media::TYPE_IMAGE,
                'url' => 'http://cdn-origin.images.akc.org.s3.amazonaws.com/reading/1/1551803547_6167_6848.jpg'
            ],
        ];

        foreach ($media as $mediae) {
            DB::table('media')->insert($mediae);
        }
    }
}
