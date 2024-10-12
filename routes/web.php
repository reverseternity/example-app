<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/forms/iconsultform', 'showIconsultForm')->name('iconsultForm');
    Route::get('/messagepage', 'showMessage')->name('messagePage');
});

Route::controller(FormController::class)->group(function (){
    Route::post('/forms/createorder', 'createOrder')->name('createOrder');
});

// Эту группу отличает использование посредника 'auth' Он позволяет открывать эти страницы только авторизованным пользователям.
// в случае, если авторизации нет, то посредник сделает редирект на маршрут loginForm.
Route::controller(StaffController::class)->middleware('auth')->group(function (){
    Route::get('/crm', 'showCrm')->name('crm');
    Route::get('/crm/{clientId}', 'showClientProfile')->name('clientProfile');
    Route::get('/crm/{clientId}/edit', 'editClientProfile')->name('editClient');
    Route::post('/forms/{clientId}/updateClient', 'updateClient')->name('updateClient');
    Route::post('/forms/{clientId}/deleteClient', 'deleteClient')->name('deleteClient');
});

// Посредники можно применять к группам маршрутов. Их действие будет распостраняться на все маршруты в группе.
// Если в аргумент к middleware() объявить массив, то можно будет использовать сразу несколько посредников.
Route::controller(RegisterController::class)->middleware('guest')->group(function (){
    Route::get('/register', 'showIndex')->name('registerForm');
    Route::post('/register', 'register')->name('registerAction');
});

// Функция middleware('имя посредника') вызывает посредник из app/Http/Kernel.php. 'guest'- это алиас, который вызывает экземпляр класса
// \App\Http\Middleware\RedirectIfAuthenticated. Его внутренний метод handle() проверяет, залогинен ли пользователь. Если нет, то он дает
// маршруту сработать. Если да, то делает редирект константой HOME. Она прописывается в Providers/RouteServiceProvider. У меня назначен адрес '/'.
Route::controller(LoginController::class)->middleware('guest')->group(function (){
    Route::get('/login', 'showIndex')->name('loginForm');
    Route::post('/login', 'login')->name('loginAction');
// Метод withoutMiddleware('имя посредника') позволяет проигнорировать выбранный посредник, когда его действие распостраняется
// на всю группу.
    Route::post('/logout', 'logout')->name('logoutAction')->withoutMiddleware('guest');
});
