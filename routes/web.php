<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Person\Controller\PersonController;
use App\Modules\Address\Controller\AddressController;

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

Route::get('/address', [AddressController::class, 'worker']);
Route::post('/address', [AddressController::class, 'worker']);


Route::get('/person', [PersonController::class, 'worker']);
Route::post('/person', [PersonController::class, 'worker']);

Route::get('/', fn() => redirect('/person'));
