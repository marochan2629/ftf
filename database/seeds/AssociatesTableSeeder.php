<?php

use Illuminate\Database\Seeder;

class AssociatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('associates')->insert([
            'name' => 'associate1',
            'email' => 'associate@test.com',
            'age' => 40,
            'religion_id' => 1,
            'country' => '日本',
            'password' => Hash::make('password'),
        ]);
    }
}
