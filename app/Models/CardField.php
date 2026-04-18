<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardField extends Model
{
    protected $fillable = ['card_id', 'label', 'type', 'options', 'required', 'order'];
    protected $casts    = ['options' => 'array', 'required' => 'boolean'];

    public function card()  { return $this->belongsTo(Card::class); }
    public function values() { return $this->hasMany(CardSubmissionValue::class, 'field_id'); }
}
