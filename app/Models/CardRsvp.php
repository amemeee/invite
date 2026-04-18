<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardRsvp extends Model
{
    protected $fillable = ['card_id', 'guest_name', 'guest_email', 'status', 'note'];

    public function card() { return $this->belongsTo(Card::class); }
}
