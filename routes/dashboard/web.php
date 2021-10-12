<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
// use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], 
    function(){ 
        
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){


            Route::get('/index', 'DashboardController@index')->name('index');

            //user route 
            Route::resource('users', 'UserController')->except(['show']);

            //category route 
            Route::resource('categories', 'CategoryController')->except(['show']);

            //product route 
            Route::resource('products', 'ProductController')->except(['show']);

            
            
        });//end of dashboard routes
        
    });