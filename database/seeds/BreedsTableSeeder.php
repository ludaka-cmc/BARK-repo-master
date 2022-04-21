<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BreedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $breedlist_json = file_get_contents(__dir__ . '/../data/breedlist.json');
        $breeds = json_decode($breedlist_json, true);

        $breeds[] = [
            'force_id' => 9999,
            'id' => 99999,
            'breed_name' => 'other',
            'breed_name_display' => 'All-American Dog / Mixed',
            'group' => 'none',
            'rank' => 0,
            'url' => 'https://www.akc.org/register/information/canine-partners/'
        ];

        foreach ($breeds as $breed) {
            $breed_formatted = [
                'wp_post_id' => $breed['id'],
                'breed_name' => $breed['breed_name'],
                'breed_name_display' => $breed['breed_name_display'],
                'breed_group' => $breed['group'],
                'breed_rank' => $breed['rank'],
                'url' => $breed['url']
            ];

            if (isset($breed['force_id'])) {
                $breed_formatted['id'] = $breed['force_id'];
            }

            DB::table('breeds')->insert($breed_formatted);
        }
    }
}
