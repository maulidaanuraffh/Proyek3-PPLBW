<?php
use App\Http\Controllers\ActivityController;
use App\Models\Activity;
use Illuminate\Support\Facades\Route; 
 
Route::get('/', function () {
    return redirect()->route('activities.index');
});

Route::resource('activities', ActivityController::class);