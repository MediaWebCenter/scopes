<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
//https://www.cloudways.com/blog/lumen-rest-api-authentication/ como autenticar con api_token
class Authenticate
{
    
    protected $auth;

    
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            return response()->json(['error' => 'No tiene autorizacion para entrar o su token ha expirado o ha excedido el limite peticiones a la API'], 401);
        }
       

        return $next($request);
    }
}
