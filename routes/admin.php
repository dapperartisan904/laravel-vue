<?php

use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CommandsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
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

Route::view('/', 'admin/dashboard')->name('index');
Route::put('news/{news}/star', [NewsController::class, 'star'])->name('news.star');

Route::resources(
    [
        'news'     => NewsController::class,
        'category' => CategoriesController::class,
        'slider'   => SliderController::class,
        'product'  => ProductsController::class,
        'user'     => UserController::class,
        'carousel' => CarouselController::class,
    ]);


Route::middleware('can:special-admin')->name('special.')->group(
    function ($routes) {
        $routes->get('commands', [CommandsController::class, 'index'])->name('commands.index');
        $routes->get('command/migration', [CommandsController::class, 'migrations'])->name('commands.migrations');
    }
);
