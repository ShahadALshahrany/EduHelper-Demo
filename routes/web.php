<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome-page');
});

Route::get('/tools', function () {
    return view('tools');
});

Route::get('/image-to-speech', function () {
    return view('image-to-speech');
});

Route::get('/processing', function () {
    return view('processing');
})->name('processing');

Route::get('/result', function () {
    return view('result');
})->name('result');