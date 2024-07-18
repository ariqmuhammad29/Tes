<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Website\About\AboutController;
use App\Http\Controllers\Website\Article\ArticleController;
use App\Http\Controllers\Website\Contact\ContactController;
use App\Http\Controllers\Website\Gallery\PhotoController;
use App\Http\Controllers\Website\Gallery\VideoController;
use App\Http\Controllers\Website\Team\TeamController;
use App\Http\Controllers\Website\Home\HomeController;
use App\Http\Controllers\Website\Service\ServiceController;
use App\Http\Controllers\Website\Portofolio\PortofolioController;
use Illuminate\Support\Facades\Route;

if ($this->app->environment('production')) {
    \URL::forceScheme('https');
}

Route::get('/', [HomeController::class, 'index'])->name('landing.index');
Route::get('/u/{slug}', [HomeController::class, 'tamu'])->name('landing.tamu');
Route::post('/confirm/{id}', [HomeController::class, 'confirm'])->name('landing.confirm');

// Route::get('/our-team', [AboutController::class, 'index'])->name('about.index');

Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/service/{slug}', [ServiceController::class, 'show'])->name('service.show');

Route::get('/our-team', [TeamController::class, 'index'])->name('team.index');
Route::get('/our-team/{slug}', [TeamController::class, 'show'])->name('team.show');

Route::get('/ourworks', [PhotoController::class, 'index'])->name('gallery.photo');
Route::get('/ourworks/{slug}', [PhotoController::class, 'show'])->name('gallery.show');
// Route::get('/gallery/photo', [PhotoController::class, 'index'])->name('gallery.photo');
// Route::get('/gallery/video', [VideoController::class, 'index'])->name('gallery.video');

Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio.index');
Route::get('/portofolio/{slug}', [PortofolioController::class, 'show'])->name('portofolio.show');

Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/category/{slug}', [ArticleController::class, 'category'])->name('article.category');
Route::get('/search', [ArticleController::class, 'search'])->name('article.search');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::post('/subscribe/store', [ContactController::class, 'subscribe'])->name('subscribe.store');

// clear cache di shared hosting
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});
