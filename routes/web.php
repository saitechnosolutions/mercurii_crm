<?php

use App\Http\Controllers\ProductCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\VendorController;

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

// product category
Route::get('/product-categories', [ProductController::class, 'productCategoryList'])->name('product-categories');
Route::post('/add-category-action', [ProductCategoryController::class, 'addCategoryFunction']);
Route::post('/edit-category-action', [ProductCategoryController::class, 'editCategoryFunction']);
Route::get('/delete-category/{catId}',[ProductCategoryController::class, 'deleteCategoryFunction']);

// products routes

Route::view('/addproduct','pages.productadd');
Route::post('/addproduct', [ProductController::class, 'store'])->name('products.store');
Route::get('/updateProductData/{productId}', [ProductController::class, 'updateProductData']);
Route::post('/updateProduct', [ProductController::class, 'updateProduct'])->name('products.update');
Route::get('/get-products/{catId}', [ProductController::class, 'getProductData']);

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
Route::post('/lead/update-Statusdf', [Controller::class, 'updateStatusdf'])->name('lead.updateStatusdf');
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
Route::post('/shifandfreports', [Controller::class,'shifandfreports']);
// orf
Route::get('/orf/{id}',[Controller::class, 'createorf'])->name('createorf');
Route::post('/store-orf', [OrfController::class, 'store'])->name('orf.store');
Route::get('/vieworf', [OrfController::class, 'vieworf'])->name('pages.vieworf');
Route::get('/vieworfapp', [OrfController::class, 'vieworfapp'])->name('pages.vieworfapp');
Route::post('/orf/insert-statusorf', [OrfController::class, 'insertStatusorf'])->name('orf.insertStatusorf');
Route::post('/orf/update-csstatus', [OrfController::class, 'updatecsStatusorf'])->name('orf.updatecsStatusorf');
Route::view('/invoice','quotations.invoice');
Route::get('/orfdetail/view/{id}', [OrfController::class, 'vieworfinvoice'])->name('orfdetail.view');

// activities
Route::view('/activities', 'pages.createactivities')->name('activities');

// quotatu
Route::get('/viewconverted', [Controller::class, 'viewconvert'])->name('pages.viewconverted');
Route::get('/viewquota', [Controller::class, 'viewquota'])->name('pages.viewquotation');


// reports

Route::view('/viewreport', 'pages.reports');
// Route::view('/vendorinvoice', 'quotations.vendorinvoice');
Route::get('/viewreport', [ReportController::class, 'showReports']);

// vendor
Route::get('/vendors', [VendorController::class, 'viewVendors'])->name('pages.vendor.vendorList');
Route::get('/purchase-order', [VendorController::class, 'viewPurchaseOrder'])->name('purchase-order-page');
Route::view('/create-po','pages.vendor.addPurchaseOrder')->name('pages.vendor.create-po');
Route::view('/purchase-entry', "pages.vendor.purchaseEntry");
Route::view('/vendor/po-invoice', "pages.vendor.po_invoice");
Route::view('/add-vendors','pages.vendor.addVendors')->name('pages.vendor.addVendors');
Route::view('/edit-vendors','pages.vendor.editVendors')->name('pages.vendor.editVendors');
Route::post('/saveVendors',[VendorController::class,'saveVendors'])->name('add-vendors');
Route::post('/save-po',[VendorController::class,'savePo']);

// terms&conditions
Route::get('/terms', [TermController::class, 'viewterms'])->name('terms.view');
Route::view('/addterms','pages.addterms')->name('pages.addterms');
Route::post('/saveterms', [TermController::class, 'store'])->name('terms.store');
Route::get('/terms/edit/{id}', [TermController::class, 'edit'])->name('terms.edit');
Route::put('/terms/update/{id}', [TermController::class, 'update'])->name('terms.update');
Route::delete('/terms/delete/{id}', [TermController::class, 'destroy'])->name('terms.destroy');
Route::put('/terms/approve/{id}', [TermController::class, 'approve'])->name('terms.approve');

