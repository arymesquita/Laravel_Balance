<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BalanceController;


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

Route::group(['middleware' => ['auth'], 'namespace'=>'Admin', 'prefix' => 'admin'], function() {

    
    
    Route::any('historic-search',[BalanceController::class,'searchHistoric'])->name('historic.search');
    Route::get('historic',[BalanceController::class,'historic'])->name('transfer.historic');

    Route::post('transfer',[BalanceController::class,'transferStore'])->name('transfer.store');

    Route::post('confirm_transfer',[BalanceController::class,'confirmTransfer'])->name('confirm.transfer');
    Route::get('transfer',[BalanceController::class,'transfer'])->name('balance.transfer');

    Route::post('withdrawn',[BalanceController::class,'withdrawnStore'])->name('withdrawn.store');
    Route::get('withdrawn',[BalanceController::class,'withdrawn'])->name('balance.withdrawn');

    Route::post('deposit',[BalanceController::class,'depositStore'])->name('deposit.store');
    Route::get('deposit',[BalanceController::class,'deposit'])->name('balance.deposit');

    Route::get('balance',[BalanceController::class,'index'])->name('admin.balance');
    Route::get('/',[AdminController::class,'index'])->name('admin.home');
    
    
    

});


Route::get('/',[SiteController::class,'index']);

Auth::routes();

