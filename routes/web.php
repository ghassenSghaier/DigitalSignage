<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/companies', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'CompaniesController@index'])->name('companies');
Route::post('/add-company', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'CompaniesController@store'])->name('add-company');
Route::post('/edit-company', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'CompaniesController@edit'])->name('edit-company');


Route::get('/buses', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'BusesController@index'])->name('buses');
Route::post('/add-bus', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'BusesController@store'])->name('add-bus');
Route::post('/edit-bus', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'BusesController@edit'])->name('edit-bus');

Route::get('/ads', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'AdsController@index'])->name('ads');
Route::post('/search-bus-disp', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'AdsController@search'])->name('search-bus-disp');
Route::post('/add-ad', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'AdsController@store'])->name('add-ad');
Route::post('/delete-ad', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'AdsController@delete'])->name('delete-ad');
//Route::post('/edit-bus', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'BusesController@edit'])->name('edit-bus');

Route::get('/users', ['middleware'=>['auth' , 'CheckClient'], 'uses'=>'UsersController@index'])->name('users');
Route::post('/add-user', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'UsersController@store'])->name('add-user');
Route::post('/edit-user/{id}', ['middleware'=>['auth', 'CheckClient'], 'uses'=>'UsersController@edit'])->name('edit-user');


Route::get('/access', ['middleware'=>['auth'], 'uses'=>'UsersController@access'])->name('access');

Route::get('/bus-pub/{id}', ['middleware'=>['auth'], 'uses'=>'BusesController@bus_pub'])->name('bus-pub');
