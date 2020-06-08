<?php

use App\User;
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
        // $this->call(UserSeeder::class);
        User::Create([
            'name'=>'Nabin',
            'email'=>'giri.nabin1994@gmail.com',
            'password'=>bcrypt('admin@123!')
        ]);
    }
}
