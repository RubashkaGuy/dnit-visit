<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::post('/contact', [SiteController::class, 'storeContact'])->name('contact.store');
Route::get('/novosti', [SiteController::class, 'newsIndex'])->name('news.index');
Route::get('/novosti/{slug}', [SiteController::class, 'newsShow'])->name('news.show');
