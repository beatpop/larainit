<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$faker = \Faker\Factory::create('zh_CN'); // 填充中文数据（姓名、地址、手机号等）
$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'cellphone' => '13800' . rand(12, 19). '8' . rand(100, 999),
        'password' => bcrypt('123456'), // secret
        'remember_token' => str_random(10),
    ];
});
