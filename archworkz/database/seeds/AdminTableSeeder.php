<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();

        $superadmin = User::create([
            'name' => 'Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password')
        ]);

        $superadmin->assignRole('superadmin');

        Schema::enableForeignKeyConstraints();
    }
}
