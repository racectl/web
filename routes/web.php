<?php

use App\Http\Controllers\DevController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\RCAdmin\CommunityManagement;

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
    return view('home');
})->name('home');

Route::get('/dev', [DevController::class, 'index'])->name('dev');
Route::get('/rcadmin/community', CommunityManagement::class)->name('rcadmin.communityManagement');
