<?php

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeUserController;
use App\Http\Controllers\TypeClientsController;
use App\Http\Controllers\UnityMeasurementController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DepartamentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SectionProductController;
use App\Http\Controllers\SectorMasterController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TypeProductController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\InfoClientController;
use App\Http\Controllers\SubClientController;
use App\Http\Controllers\EventController;
use App\Models\eventUser;

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
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

//TypeUser

Route::resource('typeUser',TypeUserController::class)->middleware('auth');
Route::get('typeUser',[TypeUserController::class, 'index'])->middleware('auth');
Route::get('fetch-typeuser',[TypeUserController::class, 'fetchtypeuser'])->middleware('auth');
Route::post('typeUserCreate',[TypeUserController::class, 'store'])->middleware('auth');
Route::post('typeUser',[TypeUserController::class, 'action'])->name('typeUser.action')->middleware('auth');
Route::get('edit-typeUser/{id}',[TypeUserController::class, 'edit'])->middleware('auth');
Route::put('update-typeUser/{id}',[TypeUserController::class, 'update'])->middleware('auth');
Route::delete('delete-typeUser/{id}',[TypeUserController::class, 'destroy'])->middleware('auth');

//end TypeUser


//TypeClient

Route::resource('typeClient', TypeClientsController::class)->middleware('auth');
Route::get('typeClient',[TypeClientsController::class, 'index'])->middleware('auth');
Route::get('fetch-typeclient',[TypeClientsController::class, 'fetchtypeclients'])->middleware('auth');
Route::post('typeClient',[TypeClientsController::class, 'store'])->middleware('auth');
Route::post('typeClientSearch',[TypeClientsController::class, 'action'])->name('typeClientSearch.action')->middleware('auth');
Route::get('edit-typeClient/{id}',[TypeClientsController::class, 'edit'])->middleware('auth');
Route::get('typeClientPaginate',[TypeClientsController::class, 'paginate'])->middleware('auth');
Route::put('update-typeClient/{id}',[TypeClientsController::class, 'update'])->middleware('auth');
Route::delete('delete-typeClient/{id}',[TypeClientsController::class, 'destroy'])->middleware('auth');

//endTypeClient

//UnityMeasurement

Route::resource('unityMeasurement', UnityMeasurementController::class)->middleware('auth');
Route::get('unityMeasurement',[UnityMeasurementController::class, 'index'])->middleware('auth');
Route::get('fetch-unitymeasurement',[UnityMeasurementController::class, 'fetchunitymeasurement'])->middleware('auth');
Route::post('unityMeasurement',[UnityMeasurementController::class, 'store'])->middleware('auth');
Route::post('unitySearch',[UnityMeasurementController::class, 'action'])->name('unitySearch.action')->middleware('auth');
Route::get('edit-unityMeasurement/{id}',[UnityMeasurementController::class, 'edit'])->middleware('auth');
Route::put('update-unityMeasurement/{id}',[UnityMeasurementController::class, 'update'])->middleware('auth');
Route::delete('delete-unityMeasurement/{id}',[UnityMeasurementController::class, 'destroy'])->middleware('auth');

//endUnityMeasurement

//Country

Route::resource('country', CountriesController::class)->middleware('auth');
Route::get('country',[CountriesController::class, 'index'])->middleware('auth');
Route::get('fetch-country',[CountriesController::class, 'fetchcountry'])->middleware('auth');
Route::post('country',[CountriesController::class, 'store'])->middleware('auth');
Route::post('countrySearch',[CountriesController::class, 'action'])->name('countrySearch.action')->middleware('auth');
Route::get('edit-country/{id}',[CountriesController::class, 'edit'])->middleware('auth');
Route::put('update-country/{id}',[CountriesController::class, 'update'])->middleware('auth');
Route::delete('delete-country/{id}',[CountriesController::class, 'destroy'])->middleware('auth');

//endcountry

//City

Route::resource('city', CitiesController::class)->middleware('auth');
Route::get('city',[CitiesController::class, 'index'])->middleware('auth');
Route::get('fetch-city',[CitiesController::class, 'fetchcity'])->middleware('auth');
Route::post('city',[CitiesController::class, 'store'])->middleware('auth');
Route::post('citySearch',[CitiesController::class, 'action'])->name('citySearch.action')->middleware('auth');
Route::get('edit-city/{id}',[CitiesController::class, 'edit'])->middleware('auth');
Route::put('update-city/{id}',[CitiesController::class, 'update'])->middleware('auth');
Route::delete('delete-city/{id}',[CitiesController::class, 'destroy'])->middleware('auth');

//endCity

//Departament

Route::resource('departament', DepartamentsController::class)->middleware('auth');
Route::get('departament',[DepartamentsController::class, 'index'])->middleware('auth');
Route::get('fetch-departament',[DepartamentsController::class, 'fetchdepartament'])->middleware('auth');
Route::post('departament',[DepartamentsController::class, 'store'])->middleware('auth');
Route::post('departamentSearch',[DepartamentsController::class, 'action'])->name('departamentSearch.action')->middleware('auth');
Route::get('edit-departament/{id}',[DepartamentsController::class, 'edit'])->middleware('auth');
Route::put('update-departament/{id}',[DepartamentsController::class, 'update'])->middleware('auth');
Route::delete('delete-departament/{id}',[DepartamentsController::class, 'destroy'])->middleware('auth');

//endDepartament

//TypeProduct

Route::resource('typeProduct', TypeProductController::class)->middleware('auth');
Route::get('typeProduct',[TypeProductController::class, 'index'])->middleware('auth');
Route::get('fetch-typeProduct',[TypeProductController::class, 'fetchtypeproduct'])->middleware('auth');
Route::post('typeProduct',[TypeProductController::class, 'store'])->middleware('auth');
Route::post('typeProductSearch',[TypeProductController::class, 'action'])->name('typeProductSearch.action')->middleware('auth');
Route::get('edit-typeProduct/{id}',[TypeProductController::class, 'edit'])->middleware('auth');
Route::put('update-typeProduct/{id}',[TypeProductController::class, 'update'])->middleware('auth');
Route::delete('delete-typeProduct/{id}',[TypeProductController::class, 'destroy'])->middleware('auth');

//endTypeProduct

//Section

Route::resource('section', SectionController::class)->middleware('auth');
Route::get('section',[SectionController::class, 'index'])->middleware('auth');
Route::get('fetch-section',[SectionController::class, 'fetchsection'])->middleware('auth');
Route::post('section',[SectionController::class, 'store'])->middleware('auth');
Route::post('sectionSearch',[SectionController::class, 'action'])->name('sectionSearch.action')->middleware('auth');
Route::get('edit-section/{id}',[SectionController::class, 'edit'])->middleware('auth');
Route::put('update-section/{id}',[SectionController::class, 'update'])->middleware('auth');
Route::delete('delete-section/{id}',[SectionController::class, 'destroy'])->middleware('auth');

//endSection

//Product
Route::resource('product', ProductController::class)->middleware('auth');
//endProduct

//SectionProduct
Route::resource('sectionProduct', SectionProductController::class)->middleware('auth');
//endSectionProduct


//SectorMaster

Route::resource('sectorMaster', SectorMasterController::class)->middleware('auth');
Route::get('sectorMaster',[SectorMasterController::class, 'index'])->middleware('auth');
Route::get('fetch-sectorMaster',[SectorMasterController::class, 'fetchsectormaster'])->middleware('auth');
Route::post('sectorMaster',[SectorMasterController::class, 'store'])->middleware('auth');
Route::post('sectorSearch',[SectorMasterController::class, 'action'])->name('sectorSearch.action')->middleware('auth');
Route::get('edit-sectorMaster/{id}',[SectorMasterController::class, 'edit'])->middleware('auth');
Route::put('update-sectorMaster/{id}',[SectorMasterController::class, 'update'])->middleware('auth');
Route::delete('delete-sectorMaster/{id}',[SectorMasterController::class, 'destroy'])->middleware('auth');

//endSectorMaster

//Clients
Route::resource('client', ClientController::class)->middleware('auth');
Route::get('client',[ClientController::class, 'index'])->middleware('auth');
Route::get('fetch-client',[ClientController::class, 'fetchclient'])->middleware('auth');
Route::post('client',[ClientController::class, 'store'])->name('create.client')->middleware('auth');
Route::post('clientSearch',[ClientController::class, 'action'])->name('clientSearch.action')->middleware('auth');
Route::get('edit-client/{id}',[ClientController::class, 'edit'])->middleware('auth');
Route::get('view-client/{id}',[ClientController::class, 'viewInfoClient'])->middleware('auth');
Route::put('update-client/{id}',[ClientController::class, 'update'])->middleware('auth');
Route::delete('delete-client/{id}',[ClientController::class, 'destroy'])->middleware('auth');
//endClients

//Warehouse
/*
Route::resource('warehouse', WarehouseController::class)->middleware('auth');
Route::get('warehouse',[WarehouseController::class, 'index'])->middleware('auth');
Route::get('fetch-warehouse',[WarehouseController::class, 'fetchwarehouse'])->middleware('auth');
Route::post('warehouse',[WarehouseController::class, 'store'])->middleware('auth');
Route::post('warehouse',[WarehouseController::class, 'action'])->name('warehouse.action')->middleware('auth');
Route::get('edit-warehouse/{id}',[WarehouseController::class, 'edit'])->middleware('auth');
Route::put('update-warehouse/{id}',[WarehouseController::class, 'update'])->middleware('auth');
Route::delete('delete-warehouse/{id}',[WarehouseController::class, 'destroy'])->middleware('auth');
*/
//endWarehouse

//infoClient

Route::resource('infoClient', InfoClientController::class)->middleware('auth');
    //client
    Route::get('fetch-info/{id}',[InfoClientController::class, 'fetchinfoclient'])->middleware('auth');
    //endClient
    //subClient
    Route::get('fetch-subclient/{id}',[InfoClientController::class, 'fetchsubclient'])->middleware('auth');
    Route::post('subclient',[InfoClientController::class, 'storesubclient'])->middleware('auth');
    Route::post('subclientSearch',[InfoClientController::class, 'action'])->name('subclientSearch.action')->middleware('auth');
    Route::get('edit-subClient/{id}',[InfoClientController::class, 'editsubclient'])->middleware('auth');
    Route::put('/update-subClient/{id}',[InfoClientController::class, 'updatesubclient'])->middleware('auth');
    Route::delete('/delete-subClient/{id}',[InfoClientController::class, 'destroysubClient'])->middleware('auth');
    //endSubClient
    //site
    Route::get('fetch-site/{id}',[InfoClientController::class, 'fetchsite'])->middleware('auth');
    Route::post('site-info',[InfoClientController::class, 'storesite'])->middleware('auth');
    Route::post('siteSearch',[InfoClientController::class, 'siteSearch'])->name('siteSearch.siteSearch')->middleware('auth');
    Route::get('edit-site/{id}',[InfoClientController::class, 'editsite'])->middleware('auth');
    Route::put('update-site/{id}',[InfoClientController::class, 'updatesite'])->middleware('auth');
    Route::delete('/delete-site/{id}',[InfoClientController::class, 'destroysite'])->middleware('auth');
    //endSite

//endinfoClient

//Site

Route::resource('site', SiteController::class)->middleware('auth');
Route::get('fetch-siteQ/{id}',[SiteController::class, 'fetchsiteQ'])->middleware('auth');
    //warehouse
        Route::get('fetch-warehouse/{id}',[SiteController::class, 'fetchwarehouse'])->middleware('auth');
        Route::post('warehouse',[SiteController::class, 'storewarehouse'])->middleware('auth');
        Route::post('warehouseSiteSearch',[SiteController::class, 'action'])->name('warehouseSiteSearch.action')->middleware('auth');
        Route::get('edit-warehouse/{id}',[SiteController::class, 'editwarehouse'])->middleware('auth');
        Route::put('update-warehouse/{id}',[SiteController::class, 'updatewarehouse'])->middleware('auth');
        Route::delete('delete-warehouse/{id}',[SiteController::class, 'destroywarehouse'])->middleware('auth');
    //endWarehouse

//endSite

//calendar
Route::get('event', [EventController::class,'index'])->name('event.index')->middleware('auth');
Route::post('event', [EventController::class,'store'])->name('event.store')->middleware('auth');
Route::patch('event/update/{id}', [EventController::class,'update'])->name('event.update')->middleware('auth');
Route::delete('event/destroy/{id}', [EventController::class,'destroy'])->name('event.destroy')->middleware('auth');
//endCalendar

//Event User
Route::get('eventUser', [eventUser::class,'index'])->name('eventUser.index')->middleware('auth');
Route::post('eventUser', [eventUser::class,'store'])->name('eventUser.store')->middleware('auth');
Route::patch('eventUser/update/{id}', [eventUser::class,'update'])->name('eventUser.update')->middleware('auth');
Route::delete('eventUser/destroy/{id}', [EventController::class,'destroy'])->name('eventUser.destroy')->middleware('auth');
// End Event User

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth', 'verified');