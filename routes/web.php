<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrolleyController;
use App\Http\Controllers\PurchaorderController;
use  App\Mail\EviarCorreo;
use Illuminate\Support\Facades\Mail;
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
/***********PAGINAS PRINCIPALES **************************/
Route::get('/', [HomeController::class, 'Index'])->name('home');
Route::get('/register', [HomeController::class, 'Register'])->name('register');
Route::get('/login', [HomeController::class, 'Login'])->name('login');
Route::get('/dashboard', [HomeController::class, 'Dashboard'])->name('dashboard');
Route::get('/salir', [HomeController::class, 'Salir'])->name('salir');
/************************************/

/***********AUTORIZACION**************************/
Route::post('/registrar_usuario', [UsuarioController::class, 'Registrar_usuario'])->name('registrar_usuario');
Route::post('/buscarusuario', [UsuarioController::class, 'buscar'])->name('buscarus');
Route::post('/buscarproducto', [ProductController::class, 'buscar'])->name('buscarproducto');
Route::post('/buscarproductohome', [HomeController::class, 'buscar'])->name('buscarproductohome');
Route::post('/buscarordenecompras', [PurchaorderController::class, 'buscar'])->name('buscarordenecompras');
Route::post('/cancelar/{id}', [PurchaorderController::class, 'cancelar'])->name('cancelar');
Route::post('/enviarorden/{id}', [PurchaorderController::class, 'enviarorden'])->name('enviarorden');
Route::post('/completar/{id}', [PurchaorderController::class, 'completar'])->name('completar');
Route::put('/repartidores/{id}', [PurchaorderController::class, 'repartidores'])->name('repartidores');

Route::put('/img_completar/{id}', [PurchaorderController::class, 'img_completar'])->name('img_completar');


Route::put('/editar_usuario/{id}', [UsuarioController::class, 'update'])->name('editar_usuario');
Route::get('/showprt/{id}', [ProductController::class, 'showprt'])->name('showprt');

Route::get('/ordertcreate/{id}', [PurchaorderController::class, 'ordertcreate'])->name('ordertcreate');

Route::post('/login', [UsuarioController::class, 'Login'])->name('loginuser');
/************************************/


Route::resource('/usuarios', UsuarioController::class);
Route::resource('/product', ProductController::class);
Route::resource('/trolley', TrolleyController::class);
Route::resource('/purchaorder', PurchaorderController::class);



/***************************ENVIAR CORREOS ****************/

Route::post('/enviarcorreo', [PurchaorderController::class, 'enviarcorreo'])->name('enviarcorreo');
Route::get('/enviarcorreodestino/{id}', [PurchaorderController::class, 'enviarcorreodestino'])->name('enviarcorreodestino');