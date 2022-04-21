<?php

use Illuminate\Database\Seeder;

class TextblocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sample_homepage_content = '<h2>Content describing the benefits of the B.A.R.K. program</h2>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla libero augue, euismod sit amet nunc nec, imperdiet suscipit ligula. Fusce mollis vehicula enim, ac semper dui. Donec ac metus vel libero dictum sagittis ac a est. Nunc lacinia eleifend imperdiet. Pellentesque non sagittis turpis, nec molestie ligula. Pellentesque eget elit lacinia, fringilla libero sed, sodales ante. Proin pretium malesuada volutpat. Curabitur consectetur volutpat nibh non vehicula.</p>

        <h2>Content about prizes &amp; participation</h2>

        <p>Ut non nunc velit. Mauris libero libero, tristique varius ex quis, convallis volutpat velit. In aliquet felis ut justo lacinia, in finibus erat porta. Nunc tempus convallis quam, ut feugiat ante elementum vel. Pellentesque tempor ipsum at molestie imperdiet. Nullam ultrices pretium fermentum. Aliquam placerat fringilla nisi, id rutrum augue tempor vitae. Vestibulum vel sollicitudin magna. Maecenas lacinia laoreet nunc eget commodo. Donec sed justo arcu. Aliquam erat volutpat.</p>';

        $release_form_url = "https://akcbark.s3.amazonaws.com/pdf/release.photographer-and-dog-owner-license-agreement.pdf";

        $textblocks = [
            // volunteerinfo
            [
                'title' => 'volunteer_information_add_new',
                'description' => 'Volunteer (Add New)',
                'weight' => 100,
                'text' => 'Add New Volunteer Information',
                'page_id' => 7
            ],
            [
                'title' => 'volunteer_info_sign_up',
                'description' => 'Volunteer (Sign Up)',
                'weight' => 100,
                'text' => 'Sign me up for alerts from Public Ed!',
                'page_id' => 7
            ],
            [
                'title' => 'volunteer_info_is_canine_ambassador',
                'description' => 'Volunteer Ambassador',
                'weight' => 100,
                'text' => 'I am a Canine Ambassador',
                'page_id' => 7
            ],
            // doginfo
            [
                'title' => 'dog_info',
                'description' => 'Dog Info (Add New)',
                'weight' => 100,
                'text' => 'Add a New Dog',
                'page_id' => 8
            ],
            // homepage
            [
                'title' => 'homepage_content',
                'description' => 'Homepage',
                'weight' => 100,
                'text' => $sample_homepage_content,
                'page_id' => 1
            ],
            // all
            [
                'title' => 'all',
                'description' => '*',
                'weight' => 100,
                'text' => "<a href='{$release_form_url}' target='_blank'></a>",
                'page_id' => 1
            ],
        ];

        foreach ($textblocks as $textblock) {
            DB::table('textblocks')->insert($textblock);
        }
    }
}
