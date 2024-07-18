<?php

namespace Database\Seeders;

use App\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        DB::table('settings')->truncate();

        $settings = Setting::create([
            'key' => 'about',
            'loocale' => 'id',
            'json_value' => '{"title": "About", "description": "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.&nbsp; Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.</p>", "meta_keywords": "Keyword is Here.", "meta_description": "Description is Here."}'
        ]);

    }
}
