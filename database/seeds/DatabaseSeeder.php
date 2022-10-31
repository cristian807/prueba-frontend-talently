<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            StatusCardSeeder::class,
            CardSeeder::class
        ]);
    }
}
