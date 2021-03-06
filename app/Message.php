<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'message', 'user_id', 'picture' //'date',
    ];



    //
    public function user(){
        return $this->belongsTo('App\User');
    }
}
