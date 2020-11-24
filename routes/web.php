<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerTicketController;
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

Route::get('/', [CustomerTicketController::class, 'index'])->name('home');
Route::post('/create_ticket', [CustomerTicketController::class, 'store'])->name('create_ticket');
Route::post('/ticket_status', [CustomerTicketController::class, 'show'])->name('check_status');

Route::get('/login', [LoginController::class, 'index'])->name('login_home');
Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/home', [AdminController::class, 'index'])->middleware('auth', 'admin_only')->name('admin_home');
Route::post('/admin/create', [AdminController::class, 'store'])->middleware('auth', 'admin_only')->name('create_agent');

Route::get('/agent/home', [AgentController::class, 'index'])->middleware('auth')->name('agent_home');
Route::get('/agent/ticket', [AgentController::class, 'show'])->middleware('auth')->name('agent_show_ticket');
Route::post('/agent/reply', [AgentController::class, 'store'])->middleware('auth')->name('agent_reply');
