<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EpochController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;


// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');

Route::get('/epochs', [EpochController::class, 'index'])->name('epochs.index');
Route::get('/epochs/{epoch}', [EpochController::class, 'show'])->name('epochs.show');

// Маршрут для отображения билета
Route::get('/tickets', [TicketController::class, 'showAllTickets'])->name('tickets.index');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
Route::get('/events/{event}/ticket', [EventController::class, 'showTicket'])->name('events.ticket');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-tickets', [TicketController::class, 'showUserTickets'])->name('tickets.user');
});

// События
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{event}/purchase', [EventController::class, 'purchase'])->name('events.purchase');
Route::post('/events/{event}/purchase', [EventController::class, 'processPurchase'])->name('events.processPurchase');

// Новости
// Для администраторов
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
});

// Для пользователей
Route::get('/news/user', [NewsController::class, 'indexForUsers'])->name('news.index.user');  // Новый маршрут для пользователей
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// Админка
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/events/create', [AdminController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [AdminController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [AdminController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [AdminController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [AdminController::class, 'destroy'])->name('admin.events.destroy');
    Route::get('/tickets', [AdminController::class, 'showAllTickets'])->name('admin.tickets.index');
    Route::get('/purchased-tickets', [TicketController::class, 'showAllTickets'])->name('admin.purchasedTickets.index');
});

// Аутентификация
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');