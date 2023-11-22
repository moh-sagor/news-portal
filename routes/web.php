<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;


Route::get('/', function () {
    return view('homePage');
})->name('homePage');


// News section 
Route::get('/news', [NewsController::class, 'index'])->name('news_page.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news_page.show');

Route::middleware(['auth', 'verified'])->group(function () {
    // news 
    Route::get('/create', [NewsController::class, 'create'])->name('news_page.create');
    Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('news_page.edit');
    Route::post('/update/{id}', [NewsController::class, 'update'])->name('news_page.update');
    Route::post('/store', [NewsController::class, 'store'])->name('news_page.store');
    Route::get('/dashboard', [NewsController::class, 'dashboard'])->name('news_page.dashboard');



    // tinymce 
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});




require __DIR__ . '/auth.php';
