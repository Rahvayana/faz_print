<?php

use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Http;
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

Route::get('/', [SaleController::class,'index'])->name('sales.index');
Route::get('/create-sale', [SaleController::class,'create'])->name('sales.create');
Route::post('/store-sale', [SaleController::class,'store'])->name('sales.store');
Route::get('/show-sale/{id}', [SaleController::class,'show'])->name('sales.show');
Route::post('/update-sale/{id}', [SaleController::class,'update'])->name('sales.update');
Route::post('/delete-sale/{id}', [SaleController::class,'destroy'])->name('sales.destroy');
