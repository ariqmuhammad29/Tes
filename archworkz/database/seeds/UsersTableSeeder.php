<?php

namespace Database\Seeders;

use App\User;
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
        for ($i = 1; $i <= 5; $i++) {
            $writer = User::create([
                'name' => "Writer {$i}",
                'username' => "writer{$i}",
                'email' => "writer{$i}@gmail.com",
                'password' => bcrypt('password')
            ]);
            
            $writer->assignRole('writer');
        }

        for ($i = 1; $i <= 20; $i++) { 
            $user = User::create([
                'name' => "User {$i}",
                'username' => "user{$i}",
                'email' => "user{$i}@gmail.com",
                'password' => bcrypt('password')
            ]);
            
            $user->assignRole('user');
        }
    }
}
