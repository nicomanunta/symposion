<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable =['event_id', 'image_path'];

    // relazione con tabella events
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
