<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

//https://github.com/fzaninotto/Faker#formatters pagina con los tipos de campos a generar en faker
//generamos los campos en faker de usuarios
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
       
        'email' => $faker->email,
        'password'=> $faker->numberBetween(0,10000),
        'isactive'=>1,
        'isadmin'=>$faker->numberBetween(0,1),
        'hashed'=>Crypt::encryptString($faker->numberBetween(0,20))
        
    ];
});
//generamos en faker los campos de propietarios
$factory->define(App\Models\UserInfo::class, function (Faker\Generator $faker) {
    return [
        //usamos en random numeros entre 1-20
        'user_id' =>$faker->unique()->numberBetween( 1, 20),
        'api_token'=> encrypt($faker->numberBetween(0,30)),
        'scope' => $faker->numberBetween(1,5),
        'xrequest' => $faker->numberBetween(0,5),
        'expired_on'=>$faker->dateTimeBetween('2 hour','3 hours')
       
    ];
});