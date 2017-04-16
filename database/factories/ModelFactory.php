<?php

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'trusted' => 0,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\CommunityLink::class, function (Faker\Generator $faker) {
	return [
		'title' => $faker->sentence,
		'user_id' => function () {
			return factory('App\User')->create()->id;
		},
		'channel_id' => function() {  
			return App\Channel::inRandomOrder()->first()->id;
		},
		'link' => $faker->url,
		'approved' => 0
	];
});
