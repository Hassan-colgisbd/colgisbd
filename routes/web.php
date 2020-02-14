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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','TableController@index');
Route::post('/data/insert','TableController@insertData');
Route::post('/data/select','TableController@selectData');
Route::post('/data/update','TableController@updateData'); 
Route::get('/data/delete/{id}','TableController@deleteData');

Route::post('/data/search','TableController@searchData'); 

//Bango data sort
//Route::get('/bango/sort','TableController@sortBangoData');
Route::get('/bango/asc','TableController@ascBangoData'); 
Route::get('/bango/desc','TableController@descBangoData');

//name data sort
//Route::get('/name/sort','TableController@sortNameData');
Route::get('/name/asc','TableController@ascNameData');
Route::get('/name/desc','TableController@descNameData');

//address data sort
//Route::get('/address/sort','TableController@sortAddressData');
Route::get('/address/asc','TableController@ascAddressData');
Route::get('/address/desc','TableController@descAddressData');

//tel data sort
//Route::get('/tel/sort','TableController@sortTelData');
Route::get('/tel/asc','TableController@ascTelData');
Route::get('/tel/desc','TableController@descTelData');


