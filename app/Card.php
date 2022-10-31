<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable=[
        'name',
        'status_card_id',
        'user_id',
        'date_delivery',
    ];


    public function status()
    {
        return $this->belongsTo(StatusCard::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
