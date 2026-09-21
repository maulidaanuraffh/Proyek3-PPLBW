<?php
use App\Http\Controllers\ActivityController;
use App\Models\Activity;
use Illuminate\Support\Facades\Route; 
 
Route::get('/activities', [ActivityController::class, 'index']) 
    ->name('activities.index'); 
 
Route::get('/activities/{activity}', [ActivityController::class, 'show']) 
    ->name('activities.show'); 

Route::resource('activities', ActivityController::class);