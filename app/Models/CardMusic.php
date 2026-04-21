<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardMusic extends Model
{
    protected $fillable = ['card_id', 'title', 'source_type', 'source_value', 'autoplay'];
    protected $casts    = ['autoplay' => 'boolean'];

    public function card() { return $this->belongsTo(Card::class); }
}
