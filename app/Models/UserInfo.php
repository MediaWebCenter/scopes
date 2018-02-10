<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class UserInfo extends Model 
{
    protected $fillable = [
        'user_id','api_token', 'scope','xrequest','expired_on'
    ];

    public function usersinfo(){

        return $this->hasOne('App\Models\User');
   }

}