<?php
use Api\Routing\Route;
use Api\Http\Input;
use Api\Http\Redirect;
use Api\Http\Session;
use Api\Http\Token;
use Api\Database\DB;
use Api\View\View;

/**
 * Register Web Routes
 */


Route::get('/', function(){
    return View::view('layout/public/home');
});