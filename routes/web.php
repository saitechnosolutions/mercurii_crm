<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

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


Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('login');

Route::POST('/login',[LoginController::class,'login']);
// Route::GET('logout',[LoginController::class,'logout']);
// Route::middleware(['auth'])->group(function(){
//     Route::get('/dashboard', function () {
//         return view('pages.dashboard');
//     });
// });
// Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/get-leads', [DashboardController::class, 'getLeads'])->name('getLeads');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/get-leads', [DashboardController::class, 'getLeads'])->name('getLeads');
});

Route::get('/logout',[LoginController::class,'logout']);


// fieldroute
Route::get('/setup/fields',[FieldController::class,'FieldIndex']);
Route::POST('/savedetails',[FieldController::class,'savedetails']);
Route::get('/setup/viewform',[FieldController::class,'viewForm']);
Route::POST('/updatestatus',[FieldController::class,'updatestatus']);
Route::get('/editform/{id}',[FieldController::class,'editForm']);
Route::POST('/updateformdetails',[FieldController::class,'updateformdetails']);
Route::GET('/deletecolumn/{id}/{categoryid}/{subcatid}/{formtext}',[FieldController::class,'deletecolumn']);

// userrout
Route::view('/users','pages.user');
Route::post('/adduser', [UserController::class, 'store'])->name('users.store');
Route::post('/updateuser', [UserController::class, 'update'])->name('users.update');

// productrout
Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::view('/addproduct','pages.productadd');
Route::post('/addproduct', [ProductController::class, 'store'])->name('products.store');
Route::post('/updateproduct', [ProductController::class, 'update'])->name('products.update');

// custmorrout
Route::get('/customer', [CustomerController::class, 'customer'])->name('pages.customer');
Route::view('/addcustomer','pages.customeradd');
Route::post('/savecustomer', [CustomerController::class, 'savecustomer']);
Route::post('/getfandfrepor', [Controller::class,'getfandfrepor']);

// roleadd
Route::view('/addrole','pages.roleadd');
Route::post('/addrole', [UserController::class, 'storerole'])->name('roles.storerole');

// leadroute
Route::get('/viewleads', [Controller::class, 'index'])->name('pages.leads');
Route::view('/addleads','pages.leadaddform');
Route::post('/getfandfreports', [Controller::class,'getfandfreports']);
Route::post('/getfandfrep', [Controller::class,'getfandfrep']);
Route::post('/saveleads',[Controller::class,'saveleads']);
Route::get('/get-customer-data/{id}', [CustomerController::class, 'getCustomerData']);
Route::post('/lead/update-status', [Controller::class, 'updateStatusdf'])->name('lead.updateStatusdf');
Route::post('/upload-document', [Controller::class, 'designapproval'])->name('document.upload');
Route::get('/get-cities/{state_id}', function ($state_id) {
    return App\Models\Citylist::where('state_code', $state_id)->get();
});



// sinlelead
Route::get('/singlelead/{leadid}', [Controller::class, 'singleLead'])->name('single.lead');
Route::POST('/saveleadsproduct',[Controller::class,'saveleadsproduct']);
Route::get('/lead-edit/{id}',[Controller::class, 'leadedit'])->name('lead.edit');
Route::POST('/updatelead',[Controller::class,'updatelead']);
Route::post('/statusupdate', [Controller::class, 'updateStatus'])->name('status.update');

// quoto
Route::get('/singlequota/{leadid}', [Controller::class, 'singlequota'])->name('single.quota');
Route::get('/createquota/{leadid}',[Controller::class, 'createquota'])->name('create.quota');
Route::post('/leaddesigns/storedesign', [Controller::class, 'storedesign'])->name('leaddesigns.storedesign');
Route::post('/createestimate', [Controller::class, 'createestimate'])->name('createestimate');
Route::get('/quotation-pdf/{id}', [Controller::class, 'generatePDF'])->name('quotation.pdf');
Route::get('/quotation/view/{id}', [Controller::class, 'viewQuotation'])->name('quotation.view');
Route::view('/quopdf2','quotations.pdf2');
Route::get('/orf/{id}',[Controller::class, 'createorf'])->name('createorf');

// activities
Route::view('/activities', 'pages.createactivities')->name('activities');

// quotatu
Route::get('/viewconverted', [Controller::class, 'viewconvert'])->name('pages.viewconverted');
Route::get('/viewquota', [Controller::class, 'viewquota'])->name('pages.viewquotation');
