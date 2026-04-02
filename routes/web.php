<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employees', function () {
    return view('employees');
});

Route::get('/tasks', function () {
    return view('tasks');
});
