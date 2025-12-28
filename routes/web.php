<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return redirect()->route('members.index');
});

// MEMBERS
Route::resource('members', MemberController::class);

// stories per member
Route::get('/members/{member}/stories', 
    [MemberController::class, 'stories']
)->name('members.stories');

// SUCCESS STORIES
Route::resource('success-stories', SuccessStoryController::class);

// EVENTS
Route::resource('events', EventController::class);

// EXPORT CSV
Route::get('/members-export', 
    [MemberController::class, 'exportCsv']
)->name('members.export');
