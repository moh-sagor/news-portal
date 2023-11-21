<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;


Route::get('/', function () {
    return view('homePage');
})->name('homePage');


// News section 
Route::get('/news', [NewsController::class, 'index'])->name('news_page.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news_page.show');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // news 
    Route::get('/create', [NewsController::class, 'create'])->name('news_page.create');
    Route::post('/store', [NewsController::class, 'store'])->name('news_page.store');
    Route::get('/dashboard', [NewsController::class, 'dashboard'])->name('news_page.dashboard');


    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});




require __DIR__ . '/auth.php';
