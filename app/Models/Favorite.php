<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'event_id'];

    // relazione con tabella users
    public function users(){
        return $this->belongsTo(User::class);
    }

}
