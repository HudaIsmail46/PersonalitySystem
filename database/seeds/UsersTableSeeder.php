<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     factory(App\User::class,10)->create();
    //     $this->call(UserSeeder::class);
    // }
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$wNIDxA5tfzPm6XEsjrt0IOS9dbUrhjZSigPvzruq2Rz0BEqudStyK',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
