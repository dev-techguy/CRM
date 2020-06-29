<?php

use Illuminate\Support\Facades\Route;

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

Route::post('sms-callback', 'SMSCallBack@callback')->name('sms.call.back');
Route::livewire('/', 'crm');
Route::livewire('export', 'export');
Route::get('export/data', 'SystemController@export')->name('export');

