<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardCountdown extends Model
{
    protected $fillable = ['card_id', 'label', 'event_date'];
    protected $casts    = ['event_date' => 'datetime'];

    public function card() { return $this->belongsTo(Card::class); }
}
