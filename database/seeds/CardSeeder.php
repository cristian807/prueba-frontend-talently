<?php

use App\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    public function run()
    {
        Card::create([
            'name'=>'Agregar subtareas al kanban',
            'date_delivery'=>'2022/10/30',
            'user_id'=>null,
            'status_card_id'=>1
        ]);

        Card::create([
            'name'=>'Testing Kanban',
            'date_delivery'=>'2022/10/30',
            'user_id'=>null,
            'status_card_id'=>2
        ]);
    }
}
