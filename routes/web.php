<?php

use App\Http\Controllers\MessageViewController;
use App\Http\Controllers\TimelineController;
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

Route::get('/', [TimelineController::class, 'show'])
                ->middleware(['auth'])
                ->name('timeline');

Route::get('/message/{message}', [MessageViewController::class, 'show'])
                ->middleware(['auth'])
                ->name('message.view');

require __DIR__.'/auth.php';
