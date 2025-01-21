<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    protected $fillable = ['location_name'];

    // relazione con tabella events
    public function events(){
        return $this->hasMany(Event::class);
    }
}
