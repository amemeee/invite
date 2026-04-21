<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardGallery extends Model
{
    protected $fillable = ['card_id', 'image_path', 'caption', 'order'];

    public function card() { return $this->belongsTo(Card::class); }
}
