<?php

use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 *
 * @mixin \App\Models\User\User
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user           = new App\Models\User\User();
        $user->email    = 'saeed@eben.com';
        $user->password = '12345678';
        $user->save();
    }
}
