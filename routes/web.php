<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return User::create([
        'name' => 'Taylor',
        'email' => 'test@test.com',
        'password' => bcrypt('password'),
        'birth_date' => '01/25/1990',
    ]);
});

Route::get('/statuses', \App\Http\Controllers\UserController::class);
