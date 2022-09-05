<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
			['name' => 'name', 'value' => ''],
			['name' => 'email', 'value' => ''],
			['name' => 'address', 'value' => ''],
			['name' => 'vat', 'value' => ''],
			['name' => 'date_format', 'value' => 'Y-m-d']
		]);
    }
}
