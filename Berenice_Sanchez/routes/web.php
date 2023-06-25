<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('producto', [App\Http\Controllers\ProductosController::class, 'index'])->name('producto.index');
    Route::get('producto/agregar', [App\Http\Controllers\ProductosController::class, 'create'])->name('producto.create');
    Route::post('producto/store', [App\Http\Controllers\ProductosController::class, 'store'])->name('producto.store');
    Route::get('producto/{producto}/edit', [App\Http\Controllers\ProductosController::class, 'edit'])->name('producto.edit');
    Route::put('producto/{producto}', [App\Http\Controllers\ProductosController::class, 'update'])->name('producto.update');
    Route::get('producto/{producto}', [App\Http\Controllers\ProductosController::class, 'show'])->name('producto.show');
    Route::delete('producto/{producto}', [App\Http\Controllers\ProductosController::class, 'destroy'])->name('producto.destroy');
    Route::get('producto/activar/{id}', [App\Http\Controllers\ProductosController::class, 'activar'])->name('productos.activar');
});




Route::get('moneda/producto/{moneda}',[App\Http\Controllers\ProductosController::class,'moneda'])->name('producto.moneda');


Route::get('/', [App\Http\Controllers\ProductosHomeController::class,'index'])->name('productos.index');
Route::post('/buscar', [App\Http\Controllers\ProductosHomeController::class, 'buscar'])->name('productos.buscar');
Route::post('/{opc}', [App\Http\Controllers\ProductosHomeController::class, 'orderPrecio'])->name('productos.orderPrecio');
Route::get('/{url}', [App\Http\Controllers\ProductosHomeController::class, 'show'])->name('productos.show');
Route::get('proyeccion/producto/{id}',[App\Http\Controllers\ProductosHomeController::class,'mostrarGrafica'])->name('productos.mostrarGrafica');