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

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Blog\CategoryController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\About\AboutUsController;
use App\Http\Controllers\Admin\Portofolio\CategoryController as PortfolioCategory;
use App\Http\Controllers\Admin\Product\CategoryController as ProductCategory;
use App\Http\Controllers\Admin\Product\PostController as ProductPost;
use App\Http\Controllers\Admin\ContactUs\ContactUsController;
use App\Http\Controllers\Admin\Client\ChangeOrderController;
use App\Http\Controllers\Admin\Client\ClientController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Gallery\ImageController;
use App\Http\Controllers\Admin\Gallery\VideoController;
use App\Http\Controllers\Admin\Inbox\InboxController;
use App\Http\Controllers\Admin\Jam\JamController;
use App\Http\Controllers\Admin\Portofolio\PortofolioController;
use App\Http\Controllers\Admin\Setting\AboutController;
use App\Http\Controllers\Admin\Info\InfoController;
use App\Http\Controllers\Admin\Setting\BasicInfoController;
use App\Http\Controllers\Admin\Setting\BreadcrumbController;
use App\Http\Controllers\Admin\Setting\LogoController;
use App\Http\Controllers\Admin\Setting\PopupsController;
use App\Http\Controllers\Admin\Service\ServiceController;
use App\Http\Controllers\Admin\Keunggulan\KeunggulanController;
use App\Http\Controllers\Admin\Page\PageController;
use App\Http\Controllers\Admin\Subscribe\SubscribeController;
use App\Http\Controllers\Admin\Slider\SliderController;
use App\Http\Controllers\Admin\Footer\FooterController;
use App\Http\Controllers\Admin\SocialMedia\SocialMediaController;
use App\Http\Controllers\Admin\Tamu\TamuController;
use App\Http\Controllers\Admin\Team\ChangeOrderController as TeamChangeOrderController;
use App\Http\Controllers\Admin\Team\TeamController;
use App\Http\Controllers\Admin\Tool\ToolController;
use App\Http\Controllers\Admin\Testimoni\TestimoniController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\Menus\MenusController;
use App\Http\Controllers\Admin\Submenus\SubmenusController;
use App\Http\Controllers\Website\Contact\ContactController;
use Illuminate\Support\Facades\Route;
use Ibnujakaria\FileManager\Support\Facades\FileManager;

Route::group(['prefix' => 'admin-panel', 'as' => 'admin.'], function () {
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
        Route::post('/login', [LoginController::class, 'store'])->name('auth.login.process');
        Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
    });

    Route::middleware('auth:web', 'permission:admin access')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        FileManager::routes();

        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('roles/{role}/permissions', PermissionController::class);

        Route::get('/menus', [MenusController::class, 'index'])->name('menus.update');
        Route::get('/menus/create', [MenusController::class, 'create'])->name('menus.create');
        Route::post('/menus', [MenusController::class, 'store'])->name('menus.store');
        Route::delete('/menus/{menu}', [MenusController::class, 'destroy'])->name('menus.destroy');
        Route::get('/menus/{menu}/edit', [MenusController::class, 'edit'])->name('menus.edit');
        Route::patch('/menus/{menu}', [MenusController::class, 'update'])->name('menus.updated');

        Route::get('/submenus', [SubmenusController::class, 'index'])->name('submenus.update');
        Route::get('/submenus/create', [SubmenusController::class, 'create'])->name('submenus.create');
        Route::post('/submenus', [SubmenusController::class, 'store'])->name('submenus.store');
        Route::delete('/submenus/{submenu}', [SubmenusController::class, 'destroy'])->name('submenus.destroy');
        Route::get('/submenus/{submenu}/edit', [SubmenusController::class, 'edit'])->name('submenus.edit');
        Route::patch('/submenus/{submenu}', [SubmenusController::class, 'update'])->name('submenus.updated');

        Route::get('gallery/file-manager', function () {
            view()->share('menuActive', 'galleries');
            view()->share('subMenuActive', 'file-manager');
            return view('admin.gallery.file-manager.index');
        })->name('gallery.file-manager.index');

        Route::resource('gallery', ImageController::class);
        Route::resource('gallery_video', VideoController::class);

        Route::resource('clients', ClientController::class);
        Route::get('clients/{clients}/change-order/{arrow}', [ChangeOrderController::class, 'update'])
            ->name('clients.change-order');

        Route::resource('teams', TeamController::class);
        Route::get('teams/{team}/change-order/{arrow}', [TeamChangeOrderController::class, 'update'])
            ->name('teams.change-order');

        Route::name('blog.')->group(function () {
            Route::resource('blog/categories', CategoryController::class);
            Route::resource('blog/posts', PostController::class);
        });
        Route::name('portofolio.')->group(function () {
            Route::resource('portofolio/categories', PortfolioCategory::class);
            Route::resource('portofolio/posts', PortofolioController::class);
        });

        Route::name('Our-Works.')->group(function () {
            Route::resource('Our-Works/posts', ProductPost::class);
        });
        Route::resource('inboxes', InboxController::class);
        Route::get('about', [AboutUsController::class, 'edit'])->name('about.edit');
        Route::put('about', [AboutUsController::class, 'update'])->name('about.update');
        Route::get('contactUs', [ContactUsController::class, 'edit'])->name('contactUs.edit');
        Route::put('contactUs', [ContactUsController::class, 'update'])->name('contactUs.update');
        Route::get('info', [InfoController::class, 'edit'])->name('info.edit');
        Route::put('info', [InfoController::class, 'update'])->name('info.update');
        Route::resource('jam', JamController::class);
        Route::resource('pages', PageController::class);
        Route::resource('portofolio', PortofolioController::class);
        Route::resource('sliders', SliderController::class);
        Route::get('services', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('services', [ServiceController::class, 'update'])->name('services.update');
        Route::resource('subscribes', SubscribeController::class);
        Route::get('footer', [FooterController::class, 'edit'])->name('footer.edit');
        Route::put('footer', [FooterController::class, 'update'])->name('footer.update');
        Route::get('social', [SocialMediaController::class, 'edit'])->name('social.edit');
        Route::put('social', [SocialMediaController::class, 'update'])->name('social.update');
        Route::resource('tamu', TamuController::class);
        Route::resource('tools', ToolController::class);
        Route::resource('testimoni', TestimoniController::class);
        Route::resource('keunggulan', KeunggulanController::class);

        Route::prefix('undangan')
            ->name('undangan.')
            ->middleware('permission:tamu read')
            ->group(function () {
                Route::get('confirm', [TamuController::class, 'confirm'])->name('confirm');
                Route::get('coming', [TamuController::class, 'coming'])->name('coming');
            });

        Route::prefix('settings')
            ->name('settings.')
            ->middleware('permission:settings')
            ->group(function () {
                Route::get('basic-info', [BasicInfoController::class, 'edit'])->name('basic-info.edit');
                Route::put('basic-info', [BasicInfoController::class, 'update']);
                Route::get('index', [AboutController::class, 'index'])->name('about.index');
                Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
                Route::put('about', [AboutController::class, 'update'])->name('about.update');
                Route::get('logo', [LogoController::class, 'edit'])->name('logo.edit');
                Route::put('logo', [LogoController::class, 'update'])->name('logo.update');
                Route::get('breadcrumb', [BreadcrumbController::class, 'edit'])->name('breadcrumb.edit');
                Route::put('breadcrumb', [BreadcrumbController::class, 'update'])->name('breadcrumb.update');
                Route::get('popup', [PopupsController::class, 'index'])->name('popup.index');
                Route::get('popup/{popup}/edit', [PopupsController::class, 'edit'])->name('popup.edit');
                Route::patch('popup/{popup}', [PopupsController::class, 'update'])->name('popup.update');
            });
    });
});
