<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tourist\touristController;
use App\Http\Controllers\panorama\panoramaController;
use App\Http\Controllers\panorama\panoramaConnectController;
Use App\Http\Controllers\history\historyController;
Use App\Http\Controllers\culinary\culinaryController;
Use App\Http\Controllers\DashboardController;
Use App\Http\Controllers\PageUserController;
Use App\Http\Controllers\AuthController;

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
// user
// Route::get('/', function () {
//     return view('user.index');
// });
Route::get('/',[PageUserController::class,'index'])->name('dashboardAdmin');
// detail
Route::get('/gallery/tour/detail/{id}',[touristController::class,'show'])->name('detailGalleryTour');
Route::get('/gallery/history/detail/{id}',[historyController::class,'show'])->name('detailGalleryHistory');
Route::get('/gallery/culinary/detail/{id}',[culinaryController::class,'show'])->name('detailGalleryCulinary');

// explore more
Route::get('/galleryTourist',[PageUserController::class,'exploreMoreWisata'])->name('galleryTourist');
Route::get('/galleryHistory',[PageUserController::class,'exploreMoreSejarah'])->name('galleryHistory');
Route::get('/galleryCulinery',[PageUserController::class,'exploreMoreKuliner'])->name('galleryCulinery');

// detail
Route::get('/detail',function () {
    return view('user.detail');
})->name('galleryDetail');

// auth
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login-proses',[AuthController::class,'proces_login'])->name('login_proses');
Route::get('/login-logout',[AuthController::class,'proces_logout'])->name('logout_proses');


// admin

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function() {

    // ==================== wisata

    Route::get('/panelAdmin/dashboard', [DashboardController::class, 'index'])->name('adminDashboard');
    Route::get('/panelAdmin/tour',[touristController::class,'index'])->name('adminWisata');
    Route::get('/panelAdmin/tour/create', [touristController::class,'create'])->name('adminWisataCreate');
    Route::post('/panelAdmin/tour/store', [touristController::class,'store'])->name('adminWisataStore');
    Route::get('/panelAdmin/tour/detail/{id}',[touristController::class,'show'])->name('adminWisataShow');
    Route::post('/panelAdmin/tour/destroy/{id}',[touristController::class,'destroy'])->name('adminWisataDestroy');
    Route::get('/panelAdmin/tour/edit/{id}',[touristController::class,'edit'])->name('adminWisataEdit');
    Route::post('/panelAdmin/tour/update/{id}',[touristController::class,'update'])->name('adminWisataUpdate');

    Route::get('/panelAdmin/tour/panorama',[panoramaController::class,'indexTour'])->name('adminWisataPanorama');
    Route::get('/panelAdmin/tour/panorama/create',[panoramaController::class,'createTour'])->name('adminWisataPanoramaCreate');
    Route::post('/panelAdmin/tour/panorama/store',[panoramaController::class,'storeTour'])->name('adminWisataPanoramaStore');
    Route::post('/panelAdmin/tour/panorama/destroy/{id}',[panoramaController::class,'destroy'])->name('adminWisataPanoramaDestroy');
    Route::post('/panelAdmin/tour/panorama/edit',[panoramaController::class,'editTour'])->name('adminWisataPanoramaEdit');
    Route::post('/panelAdmin/tour/panorama/update/{id}',[panoramaController::class,'update'])->name('adminWisataPanoramaUpdate');


    Route::get('/panelAdmin/tour/panoramaConnect',[panoramaConnectController::class,'indexTour'])->name('adminWisataPanoramaConnect');
    Route::get('/panelAdmin/tour/panoramaConnect/create',[panoramaConnectController::class,'createTour'])->name('adminWisataPanoramaConnectCreate');
    Route::post('/panelAdmin/tour/panoramaConnect/store',[panoramaConnectController::class,'storeTour'])->name('adminWisataPanoramaConnectStore');
    Route::post('/panelAdmin/tour/panoramaConnect/destroy/{id}',[panoramaConnectController::class,'destroy'])->name('adminWisataPanoramaConnectDestroy');
    Route::post('/panelAdmin/tour/panoramaConnect/edit',[panoramaConnectController::class,'editTour'])->name('adminWisataPanoramaConnectEdit');
    Route::post('/panelAdmin/tour/panoramaConnect/update/{id}',[panoramaConnectController::class,'update'])->name('adminWisataPanoramaConnectUpdate');

    
    // =============== sejarah

    Route::get('/panelAdmin/history',[historyController::class,'index'])->name('adminSejarah');
    Route::get('/panelAdmin/history/create',[historyController::class,'create'])->name('adminSejarahCreate');
    Route::post('/panelAdmin/history/store',[historyController::class,'store'])->name('adminSejarahStore');
    Route::get('/panelAdmin/history/detail/{id}',[historyController::class,'show'])->name('adminSejarahShow');
    Route::post('/panelAdmin/history/destroy/{id}',[historyController::class,'destroy'])->name('adminSejarahDestroy');
    Route::get('/panelAdmin/history/edit/{id}',[historyController::class,'edit'])->name('adminSejarahEdit');
    Route::post('/panelAdmin/history/update/{id}',[historyController::class,'update'])->name('adminSejarahUpdate');
    
    Route::get('/panelAdmin/history/panorama',[panoramaController::class,'indexHistory'])->name('adminSejarahPanorama');
    Route::get('/panelAdmin/history/panorama/create',[panoramaController::class,'createHistory'])->name('adminSejarahPanoramaCreate');
    Route::post('/panelAdmin/history/panorama/store',[panoramaController::class,'storeHistory'])->name('adminSejarahPanoramaStore');
    Route::post('/panelAdmin/history/panorama/destroy/{id}',[panoramaController::class,'destroy'])->name('adminSejarahPanoramaDestroy');
    Route::post('/panelAdmin/history/panorama/edit',[panoramaController::class,'editHistory'])->name('adminSejarahaPanoramaEdit');
    Route::post('/panelAdmin/history/panorama/update/{id}',[panoramaController::class,'update'])->name('adminSejarahPanoramaUpdate');
    
    Route::get('/panelAdmin/history/panoramaConnect',[panoramaConnectController::class,'indexHistory'])->name('adminSejarahPanoramaConnect');
    Route::get('/panelAdmin/history/panoramaConnect/create',[panoramaConnectController::class,'createHistory'])->name('adminSejarahaPanoramaConnectCreate');
    Route::post('/panelAdmin/history/panoramaConnect/store',[panoramaConnectController::class,'storeHistory'])->name('adminSejarahPanoramaConnectStore');
    Route::post('/panelAdmin/history/panoramaConnect/destroy/{id}',[panoramaConnectController::class,'destroy'])->name('adminSejarahaPanoramaConnectDestroy');
    Route::post('/panelAdmin/history/panoramaConnect/edit',[panoramaConnectController::class,'editHistory'])->name('adminSejarahPanoramaConnectEdit');
    Route::post('/panelAdmin/history/panoramaConnect/update/{id}',[panoramaConnectController::class,'update'])->name('adminSejarahPanoramaConnectUpdate');

    // ======= kuliner

    Route::get('/panelAdmin/culinary',[culinaryController::class,'index'])->name('adminKuliner');
    Route::get('/panelAdmin/culinary/create',[culinaryController::class,'create'])->name('adminKulinerCreate');
    Route::post('/panelAdmin/culinary/store',[culinaryController::class,'store'])->name('adminKulinerStore');
    Route::get('/panelAdmin/culinary/detail/{id}',[culinaryController::class,'show'])->name('adminKulinerShow');
    Route::post('/panelAdmin/culinary/destroy/{id}',[culinaryController::class,'destroy'])->name('adminKulinerDestroy');
    Route::get('/panelAdmin/culinary/edit/{id}',[culinaryController::class,'edit'])->name('adminKunlinerEdit');
    Route::post('/panelAdmin/culinary/update/{id}',[culinaryController::class,'update'])->name('adminKulinerUpdate');
});





// Route::post('/tourist_spots/photo/{id}', [touristController::class, 'deletePhoto'])->name('tourist_spots.photo.delete');








