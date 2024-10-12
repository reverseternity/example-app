<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\FormController;
use App\Http\Controllers\Api\v1\StaffController;
use App\Http\Controllers\Api\v1\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(FormController::class)->group(function (){
    Route::put('/forms/createorder', 'createOrder');
});

// Обращаться к маршрутам api можно так: {{host}}/api/{{адрес маршрута}}. Префикс /api/ добавляется с помощью метода boot()
// в файле app/Providers/RouteServiceProvider. Там же можно кастомизировать перфикс в строке 32 - Route::prefix('api'). Для указания
// этого префикса используется посредник middleware('api). Также указывается путь этому к файлу api.php - именно к маршрутам отсюда
// будет применяться этот префикс.
Route::controller(StaffController::class)->middleware('auth:sanctum')->group(function (){
    Route::get('/userprofile', 'showUserProfile')->name('api.userProfile');
    Route::get('/crm', 'showCrm')->name('api.crm');
    Route::get('/crm/{clientId}', 'showClientProfile')->name('api.clientProfile');
    Route::patch('/forms/{clientId}/updateClient', 'updateClient')->name('api.updateClient');
    Route::delete('/forms/{clientId}/deleteClient', 'deleteClient')->name('api.deleteClient');
});

Route::controller(LoginController::class)->group(function (){
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

