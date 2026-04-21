<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
 use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'event_date',
        'share_token',
    ];

    protected $casts = ['event_date' => 'datetime'];

    public function user()        { return $this->belongsTo(\App\Models\User::class); }
    public function fields()      { return $this->hasMany(CardField::class)->orderBy('order'); }
    public function submissions() { return $this->hasMany(CardSubmission::class)->latest(); }
    public function countdown()   { return $this->hasOne(CardCountdown::class); }
    public function location()   { return $this->hasOne(CardLocation::class); }
    public function music()      { return $this->hasOne(CardMusic::class); }
    public function galleries()  { return $this->hasMany(CardGallery::class)->orderBy('order'); }
    public function rsvps()      { return $this->hasMany(CardRsvp::class)->latest(); }
    public function wishes()     { return $this->hasMany(CardWish::class)->latest(); }
}
