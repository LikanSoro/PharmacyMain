<?php

use App\Http\Controllers\catagoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\customerTypeController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\manufacturerController;
use App\Http\Controllers\medicineController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\purchaseController;
use App\Http\Controllers\salesController;
use App\Http\Controllers\stockController;
use App\Http\Controllers\unitController;
use App\Models\customerType;
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
    return view('landingpage');
});
Route::get('login', function () {
    return view('auth.login');
});
Route::get('register', function () {
    return view('auth.register');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');


    // medicine catagory
    route::resource('catagory', catagoryController::class);
    route::get('fetch', [catagoryController::class, 'fetch']);

    // medicine unit
    route::resource('unit', unitController::class);
    route::get('fetchUnit', [unitController::class, 'fetchUnit']);

    // medicine
    route::resource('medicine', medicineController::class);
    route::get('fetchMedicine', [medicineController::class, 'fetchMedicine']);
    route::get('manageMedicine', [medicineController::class, 'manageMedicine']);

    // medicine purchase
    route::resource('purchase', purchaseController::class);
    route::get('fetchPurchase', [purchaseController::class, 'fetchPurchase']);
    route::get('getMedicines/{getMedicines}', [purchaseController::class, 'getMedicines']);
    route::get('getQuantity/{getQuantity}', [purchaseController::class, 'getQuantity']);
    route::get('unitPrice', [purchaseController::class, 'unitPrice']);
    route::get('managePurchase', [purchaseController::class, 'managePurchase']);

    // manufacturer
    route::resource('manufacturer', manufacturerController::class);
    route::get('fetchManufacturer', [manufacturerController::class, 'fetchManufacturer']);

    // sales
    route::resource('sales', salesController::class);
    route::get('fetchBatch/{fetchBatch}', [salesController::class, 'fetchBatch']);
    route::get('fetchExpiry/{fetchExpiry}', [salesController::class, 'fetchExpiry']);
    route::post('getMeds', [salesController::class, 'getMeds']);
    route::POST('fetchTotal/{fetchTotal}', [salesController::class, 'fetchTotal']);
    route::get('MedsCatagoryWise/{MedsCatagoryWise}', [salesController::class, 'MedsCatagoryWise']);
    route::get('fetchMeds', [salesController::class, 'fetchMeds']);
    route::post('getCustomer', [salesController::class, 'getCustomer']);
    route::get('manageSales', [salesController::class, 'manageSales']);
    route::get('fetchSales', [salesController::class, 'fetchSales']);
    route::get('generatepdf/{generatepdf}', [salesController::class, 'generatepdf']);

    // stock
    route::resource('stock', stockController::class);
    route::get('fetchStock', [stockController::class, 'fetchStock']);
    route::get('expired', [stockController::class, 'expired']);
    route::get('stock-created', [stockController::class, 'stockCreated']);
    route::get('getZeroQuantityStocks', [stockController::class, 'getZeroQuantityStocks']);
    route::post('delete', [stockController::class, 'delete']);

    //PDF
    Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
    Route::get('generate-sales-pdf', [PDFController::class, 'generateSalesPDF']);
    Route::get('downloadpdf/{downloadpdf}', [PDFController::class, 'downloadPDF']);

    // customer
    route::resource('customer', CustomerController::class);
    route::get('fetchCustomer', [CustomerController::class, 'fetchCustomer']);
    route::get('creditCustomer', [CustomerController::class, 'creditCustomer']);


    // invoice
    route::resource('invoice', invoiceController::class);
    route::get('fetchInvoice', [invoiceController::class, 'fetchInvoice']);
    route::post('invoiceStore', [invoiceController::class, 'invoiceStore']);
    route::get('manageInvoice', [invoiceController::class, 'manageInvoice']);
    route::get('fetchInvoiceType', [invoiceController::class, 'fetchInvoiceType']);
    route::post('deleteInvoiceType/{deleteInvoiceType}', [invoiceController::class, 'deleteInvoiceType']);
    route::get('invoiceData/{invoiceData}', [invoiceController::class, 'invoiceData']);
});
