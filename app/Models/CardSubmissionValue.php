<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardSubmissionValue extends Model
{
    protected $fillable = ['submission_id', 'field_id', 'value'];

    public function submission() { return $this->belongsTo(CardSubmission::class, 'submission_id'); }
    public function field()      { return $this->belongsTo(CardField::class, 'field_id'); }
}
