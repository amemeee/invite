<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardLocation extends Model
{
    protected $fillable = ['card_id', 'venue_name', 'address', 'embed_url'];

    public function card() { return $this->belongsTo(Card::class); }
}
