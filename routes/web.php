<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/profil', 'profile')->name('profile');
    Route::get('/berita', 'posts')->name('posts');
    Route::get('/berita/{slug}', 'postDetail')->name('posts.detail');
    Route::get('/pengumuman', 'announcements')->name('announcements');
    Route::get('/agenda', 'events')->name('events');
    Route::get('/galeri', 'galleries')->name('galleries');
    Route::get('/dokumen', 'documents')->name('documents');
    Route::get('/fasilitas', 'facilities')->name('facilities');
    Route::get('/prestasi', 'achievements')->name('achievements');
    Route::get('/ekstrakurikuler', 'extracurriculars')->name('extracurriculars');
    Route::get('/kontak', 'contact')->name('contact');
});
