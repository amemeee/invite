<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardWish extends Model
{
    protected $fillable = ['card_id', 'guest_name', 'message'];

    public function card() { return $this->belongsTo(Card::class); }
}
