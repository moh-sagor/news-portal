<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('homePage');
})->name('homePage');


// News section 
Route::get('/news', [NewsController::class, 'index'])->name('news_page.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news_page.show');
// category section 
Route::get('/category', [CategoryController::class, 'index'])->name('news_category.index');

Route::middleware(['auth', 'verified'])->group(function () {
    // news 
    Route::get('/create', [NewsController::class, 'create'])->name('news_page.create');
    Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('news_page.edit');
    Route::post('/update/{id}', [NewsController::class, 'update'])->name('news_page.update');
    Route::post('/store', [NewsController::class, 'store'])->name('news_page.store');
    Route::get('/dashboard', [NewsController::class, 'dashboard'])->name('news_page.dashboard');
    Route::delete('/destroy/{id}', [NewsController::class, 'destroy'])->name('news_page.destroy');



    // category 
    Route::get('/createCategory', [CategoryController::class, 'create'])->name('news_category.create');
    Route::post('/storeCategory', [CategoryController::class, 'store'])->name('news_category.store');

    // tinymce 
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});




require __DIR__ . '/auth.php';
