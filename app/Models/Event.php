<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['user_id', 'location_id', 'dress_code_id', 'event_title', 'event_subtitle', 'event_description', 'event_region', 'event_city', 'event_address', 'event_date', 'event_start', 'event_end', 'event_price', 'event_img'];

    // relazione con tabella users
    public function user(){
        return $this->belongsTo(User::class);
    }

    // relazione con tabella event_locations
    public function eventLocation(){
        return $this->belongsTo(EventLocation::class, 'location_id');
    }

    // relazione con tabella event_dress_codes
    public function eventDressCode(){
        return $this->belongsTo(EventDressCode::class, 'dress_code_id');
    }

    // relazione con tabella galleries
    public function galleries(){
        return $this->hasMany(Gallery::class);
    }

    // relazione many to many con tabella users
    public function favoritedByUsers(){
        return $this->belongsToMany(User::class, 'favorites', 'event_id', 'user_id')->withTimestamps();;
    }

}
