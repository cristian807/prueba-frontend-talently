<?php

use App\StatusCard;
use Illuminate\Database\Seeder;

class StatusCardSeeder extends Seeder
{
    public function run()
    {
        StatusCard::create([
            'name'=>'Buffer'
        ]);

        StatusCard::create([
            'name'=>'Workin'
        ]);

        StatusCard::create([
            'name'=>'Done'
        ]);
    }
}
