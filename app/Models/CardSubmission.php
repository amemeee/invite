<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardSubmission extends Model
{
    protected $fillable = ['card_id', 'submitter_ip'];

    public function card()   { return $this->belongsTo(Card::class); }
    public function values() { return $this->hasMany(CardSubmissionValue::class, 'submission_id'); }
}
