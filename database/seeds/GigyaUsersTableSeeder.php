<?php

Use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GigyaUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gigya_users = [
            [
                'user_id' => 1,
                'gigya_uid' => '571530429346419d8ec33315a65853b9',
                'provider' => null,
                'email' => 'jjc+12@akc.org'
            ],
            [
                'user_id' => 2,
                'gigya_uid' => '265d5c385ff7434d85a86e6ab5336689',
                'provider' => null,
                'email' => 'jjc+11@akc.org'
            ],
            [
                'user_id' => 3,
                'gigya_uid' => '990607843b0b4989bed6cea25bf450a8',
                'provider' => null,
                'email' => 'miguel.uy@akc.org'
            ],
            [
                'user_id' => 4,
                'gigya_uid' => 'fba23b1b92c24db78f3b5964c002d22b',
                'provider' => null,
                'email' => 'paulina.miller@akc.org'
            ],
            [
                'user_id' => 5,
                'gigya_uid' => 'e2d5ea7e4ee849239194c8ebd172f892',
                'provider' => null,
                'email' => 'sbp@akc.org'
            ],
            [
                'user_id' => 6,
                'gigya_uid' => 'a03cc66cbe3e40888cabe26f3aa1bd40',
                'provider' => null,
                'email' => 'cxo@akc.org'
            ],
            [
                'user_id' => 7,
                'gigya_uid' => '69e9525e2eff44018848dbf878a32c70',
                'provider' => 'googleplus',
                'email' => 'devariojay@gmail.com'
            ]
        ];

        foreach ($gigya_users as $gigya_user) {
            DB::table('gigya_users')->insert($gigya_user);
        }
    }
}
