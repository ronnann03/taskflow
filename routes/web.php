<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/employees', function () {
    return view('employees');
});

Route::get('/tasks', function () {
    return view('tasks');
});
