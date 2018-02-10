<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
 
class AuthController extends Controller
 
{
 
  public function __construct()
 
   {
 
     //  $this->middleware('auth:api');
 
   }
 
   
 
   public function authenticate(Request $request)
 
   {
          //Pedimos que este requerido el email y el password para obtener el token
       $this->validate($request, [
 
       'email' => 'required',
 
       'password' => 'required'
 
        ]);
 
     $user = DB::table('users')->where('email', $request->input('email'))->first();
     
    
         if($request->input('password') === $user->password){
             //generamos un api key, lo refrescamos
              $apikey= encrypt(str_random(20));
            //Actualizamos el api_key se necesita generar un token diferente cada logueo
                    DB::table('user_infos')
                    ->where('user_id', $user->id)
                    ->update(['api_token' => $apikey]);
          //arrojamos la api key que deseamos insertar
          return response()->json(['status' => 'api_token generado','api_key' => $apikey]);
 
         }else{
 
          return response()->json(['status' => 'error compruebe sus credenciales'],401);
 
      }
 
   }
 
}    