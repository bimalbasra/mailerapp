<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUsFormController;
use App\Http\Controllers\Member;


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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Email List Route
Route::get('emailTrack', [Member::class, 'show'])->middleware('auth');

//Alternative Tailwind Design Form Routes
Route::view('contactform','contactform');

Route::view('loginerror', 'loginerror');

//Set Get For Form
Route::get('/contact', [ContactUsFormController::class, 'createForm'])->middleware('auth');
//Set Post For Contact Box
Route::post('/contact', [ContactUsFormController::class, 'ContactUsForm'])->name('contact.store')->middleware('auth');

//Users Protected Route
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('/', 'HomeController@index')->name('contactform');
});

//Admin Protected Route
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin_dashboard');
});