<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';
    protected $guarded = [];

    public $timestamps = false;


    public function user(){
        return $this->belongsTo('App\User');
    }
}
