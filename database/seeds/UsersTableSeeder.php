<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Test User',
                'last_gigya_user_id' => 1,
                'email' => 'jjc+12@akc.org',
                'email_verified_at' => Carbon::now(),
                'state_id' => 37,
                'welcomeemail' => 1,
                'admin' => 1,
                'password' => null,
                'remember_token' => ''
            ],
            [
                'name' => 'Test User #2',
                'last_gigya_user_id' => 1,
                'email' => 'jjc+11@akc.org',
                'email_verified_at' => Carbon::now(),
                'state_id' => 37,
                'welcomeemail' => 1,
                'admin' => 0,
                'password' => null,
                'remember_token' => ''
            ],
            [
                'name' => 'Miguel Uy',
                'last_gigya_user_id' => 3,
                'email' => 'miguel.uy@akc.org',
                'email_verified_at' => Carbon::now(),
                'state_id' => 37,
                'welcomeemail' => 1,
                'admin' => 1,
                'password' => null,
                'remember_token' => null
            ],
            [
                'name' => 'Paulina Miller',
                'last_gigya_user_id' => 4,
                'email' => 'paulina.miller@akc.org',
                'email_verified_at' => Carbon::now(),
                'state_id' => 37,
                'welcomeemail' => 1,
                'admin' => 1,
                'password' => null,
                'remember_token' => null
            ],
            [
                'name' => 'Steve Pessah',
                'last_gigya_user_id' => 5,
                'email' => 'sbp@akc.org',
                'email_verified_at' => Carbon::now(),
                'state_id' => 37,
                'welcomeemail' => 1,
                'admin' => 1,
                'password' => null,
                'remember_token' => null
            ],
            [
                'name' => 'Esteban Chavarria',
                'last_gigya_user_id' => 6,
                'email' => 'cxo@akc.org',
                'email_verified_at' => Carbon::now(),
                'state_id' => null,
                'welcomeemail' => 1,
                'admin' => 1,
                'password' => null,
                'remember_token' => null
            ],
            [
                'name' => 'Devario JohnsonTest',
                'last_gigya_user_id' => 7,
                'email' => 'devariojay@gmail.com',
                'email_verified_at' => Carbon::now(),
                'state_id' => null,
                'welcomeemail' => 1,
                'admin' => 1,
                'password' => null,
                'remember_token' => null
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
