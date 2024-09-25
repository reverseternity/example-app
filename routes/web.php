<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(PagesController::class)->group(function (){
    Route::get('/', 'showIndex')->name('index');
    Route::get('/freeconsult', 'showFreeConsult')->name('freeConsult');
    Route::get('/individualconsult', 'showIndividualConsult')->name('individualConsult');
    Route::get('/movingassistance', 'showMovingAssistance')->name('movingAssistance');
    Route::get('/businessmarketing', 'showBusinessMarketing')->name('businessMarketing');
    Route::get('/sellbuy', 'showSellBuy')->name('sellBuy');
    Route::get('/aboutus', 'showAboutUs')->name('aboutUs');
    Route::get('/rent', 'showRent')->name('rent');
    Route::get('/termsofuse', 'showTermsofUse')->name('termsofUse');
    Route::get('/crm', 'showCrm')->name('crm');
    Route::get('/crm/{clientId}', 'showClientProfile')->name('clientProfile');
    Route::get('/crm/{clientId}/edit', 'editClientProfile')->name('editClient');
    Route::get('/forms/iconsultform', 'showIconsultForm')->name('iconsultForm');
});

Route::controller(FormController::class)->group(function (){
    Route::post('/forms/createOrder', 'createOrder')->name('createOrder');
    Route::post('/forms/{clientId}/updateClient', 'updateClient')->name('updateClient');
    Route::post('/forms/{clientId}/deleteClient', 'deleteClient')->name('deleteClient');
});

Route::controller(RegisterController::class)->group(function (){
    Route::get('/register', 'showIndex')->name('registerForm');
    Route::post('/register', 'register')->name('registerAction');
});

Route::controller(LoginController::class)->group(function (){
    Route::get('/login', 'showIndex')->name('loginForm');
    Route::post('/login', 'login')->name('loginAction');
});
