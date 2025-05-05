<?php
use App\Http\Controllers\InventoryReportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\IssuanceController;
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
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

Route::resource('items', ItemController::class);

// STOCKS
Route::resource('stocks', StockController::class);

// STOCK TRANSACTIONS
Route::resource('stock-transactions', StockController::class);
//VIEW ISSUANCE
Route::resource('issuances', IssuanceController::class);
//VIEW STOCK CARD
Route::get('/items/{item}/stockcard', [App\Http\Controllers\ItemController::class, 'stockcard'])->name('items.stockcard');
use App\Http\Controllers\InventoryController;

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory-report', [InventoryReportController::class, 'index']);

use App\Http\Controllers\MonthlyReportController;

Route::get('/monthly-report', [MonthlyReportController::class, 'index'])->name('monthly_report.index');

Route::get('monthly-report/download', [MonthlyReportController::class, 'download'])->name('monthly_report.download');

Route::get('/', function () {
    return view('welcome');
});
