<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';

Route::livewire('/setting/', 'pages::backend.setting.edit-setting')->name('setting');
Route::livewire('/profile/', 'pages::backend.profile.edit-profile')->name('profile');
Route::livewire('/education/', 'pages::backend.education.create-education')->name('education');
Route::livewire('/experience/', 'pages::backend.experience.create-experience')->name('experience');
Route::livewire('/services/', 'pages::backend.service.create-service')->name('services');
Route::livewire('/technical-skills/', 'pages::backend.technical-skill.create-technical-skill')->name('technical-skills');
Route::livewire('/personal-interests/', 'pages::backend.personal-interest.create-personal-interest')->name('personal-interests');

// frontend routes
Route::livewire('/', 'pages::frontend.home.home-page')->name('home');
