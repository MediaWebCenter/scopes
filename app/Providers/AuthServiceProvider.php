<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use  Carbon\Carbon;
use Illuminate\Contracts\Auth\Factory as Auth;

class AuthServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        //
    }

    public function boot()
    {

        $this->app['auth']->viaRequest('api', function ($request) {
          
        //preguntamos por la autorizacion del header
                if ($request->header('Authorization')) {
                    $key = explode(' ',$request->header('Authorization'));
                    $user= DB::table('user_infos')
                              ->where('api_token', $key[1])
                              ->first();
                  //comprobamos que se ha creado el objeto para poder mirar el tiempo
                       if(is_object($user)){
                           //preguntamos si la fecha es mayor de la actual  y sino no dejamos pasar 
                                    if($user->expired_on > Carbon::now()){
                                            //retornamos el usuario
                                        return $user;
                                         }
                        }
                }
        });
            

        
    }
}
