<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AiRecipeController;

Route::get('/', function () {
    return redirect()->route('recipes.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('recipes.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Breeze user profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recipe management
    Route::get('/recipes/search', [RecipeController::class, 'search'])->name('recipes.search');
    Route::put('/recipes/{recipe}/status', [RecipeController::class, 'changeStatus'])->name('recipes.changeStatus');
    Route::resource('recipes', RecipeController::class);

   

Route::get('/ai', [AiRecipeController::class, 'showForm'])->name('ai.form');
Route::post('/ai/generate', [AiRecipeController::class, 'generate'])->name('ai.generate');
});

require __DIR__.'/auth.php';
