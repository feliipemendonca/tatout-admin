<?php

use App\Http\Controllers\dashboard\AvailabilityController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\CompanyController;
use App\Http\Controllers\dashboard\ProductPriceController;
use App\Http\Controllers\dashboard\TypeProductController;
use App\Http\Controllers\dashboard\SellersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\settings\PermissionController;
use App\Http\Controllers\settings\RolesController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('index');

Route::group(['prefix' => 'dashboard' ,'as' => 'dashboard.','middleware' => 'auth'], function () {    
    Route::resources([
        'fornecedores' => CompanyController::class,
        'vendedores' => SellersController::class,
        'tipo-produto' => TypeProductController::class,
        'passeios' => ProductController::class,
        'valores-passeios' => ProductPriceController::class,
        'roles' => RolesController::class,
        'users' => UserController::class,
    ]);

    Route::resource('permission', PermissionController::class, ['except' => ['edit','show','update', 'destroy']]);
    Route::resource('passeios.agenda', AvailabilityController::class)->shallow();
    Route::delete('passeios/{id}/removefile',[ProductController::class, 'removeFile'])->name('passeio.remove.file');
    Route::get('logs', [HomeController::class, 'logs'])->name('logs');
});
