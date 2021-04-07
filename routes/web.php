<?php

use App\Http\Controllers\DevController;
use App\Http\Livewire\CommunityAdmin\EventManagement;
use App\Models\Community;
use App\Models\User;
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


Route::get('/dev', [DevController::class, 'index'])->name('dev');

Route::get('/dev/login/{user}', function (User $user = null) {
    \Illuminate\Support\Facades\Auth::login($user);
    return redirect()->back();
})->name('dev.login');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('{community:slug}', function (Community $community) {
    return redirect()->route('community.events', $community);
})->name('community');
Route::get('{community:slug}/events', \App\Http\Livewire\Community\Events::class)
    ->name('community.events');
Route::get('{community:slug}/event/{event}', \App\Http\Livewire\Community\Event\EventShow::class)
    ->name('community.event.show');

Route::get('/rcadmin/community', CommunityManagement::class)
    ->name('rcadmin.communityManagement');

Route::get('{community:slug}/admin/event-management', EventManagement::class)
    ->name('communityAdmin.EventManagement');
Route::get('{community:slug}/admin/event-management/{event}/available-cars',
    EventManagement\AccAvailableCars::class)
    ->name('communityAdmin.EventManagement.availableCars');

