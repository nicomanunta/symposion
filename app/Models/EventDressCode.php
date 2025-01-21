<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDressCode extends Model
{
    protected $fillable = ['dress_code_name'];

    // relazioe con tabella events
    public function events(){
        return $this->hasMany(Event::class);
    }
}
