<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChangelogController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ClientFunnelController;
use App\Http\Controllers\Admin\DifferentialController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\StepController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Web\CampaignController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\CookieController;
use App\Http\Controllers\Web\FilterController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PolicyController;
use App\Http\Controllers\Web\PropertyController as WebPropertyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.home');
    Route::prefix('admin')->name('admin.')->group(function () {
        /** Chart home */
        Route::get('/chart', [AdminController::class, 'chart'])->name('home.chart');

        /** Users */
        Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::resource('users', UserController::class)->except('show');

        /** Agencies */
        Route::resource('agencies', AgencyController::class)->except('show');

        /** Clients */
        Route::get('/clients/timeline/{id}', [ClientController::class, 'timeline']);
        Route::resource('clients', ClientController::class)->except('show');

        /** Clients Funnel */
        Route::post('clients-funnel-updateKanban', [ClientFunnelController::class, 'updateKanban'])->name('clients.updateKanban');
        Route::get('clients-funnel', [ClientFunnelController::class, 'index'])->name('clients.funnel');

        /** Properties */
        Route::resource('properties', PropertyController::class)->except('show');
        Route::post('/properties/images-order', [PropertyController::class, 'imagesOrder'])->name('properties.images-order');
        Route::post('/properties/image-delete', [PropertyController::class, 'imageDelete'])->name('properties.image-delete');

        /** Steps */
        Route::resource('steps', StepController::class)->except('show');

        /** Categories */
        Route::resource('categories', CategoryController::class)->except('show');

        /** Types */
        Route::resource('types', TypeController::class)->except('show');

        /** Types */
        Route::resource('differentials', DifferentialController::class)->except('show');

        /** Experiences */
        Route::resource('experiences', ExperienceController::class)->except('show');

        /**
         * ACL
         * */
        /** Permissions */
        Route::resource('permission', PermissionController::class);

        /** Roles */
        Route::get('role/{role}/permission', [RoleController::class, 'permissions'])->name('role.permissions');
        Route::put('role/{role}/permission/sync', [RoleController::class, 'permissionsSync'])->name('role.permissionsSync');
        Route::resource('role', RoleController::class);

        /** Changelog */
        Route::get('/changelog', [ChangelogController::class, 'index'])->name('changelog');
    });
});

/** Web */
Route::group(['middleware' => ['log']], function () {
    Route::name('web.')->group(function () {
        /** Home */
        Route::get('/', [HomeController::class, 'index'])->name('home');
        /** Contact */
        Route::post('/enviar-contato', [ContactController::class, 'send'])->name('contact.send');
        Route::get('/contato', [ContactController::class, 'index'])->name('contact');
        /** Policies */
        Route::get('/politica-de-privacidade', [PolicyController::class, 'index'])->name('policy');
        /** Filters */
        Route::get('/quero-comprar', [FilterController::class, 'sale'])->name('sale');
        Route::get('/quero-alugar', [FilterController::class, 'rent'])->name('rent');
        Route::get('/experiencias/{slug}', [FilterController::class, 'experience'])->name('experience');

        /** Form Filter */
        Route::post('/filtro/categorias', [FilterController::class, 'categories'])->name('categories');
        Route::post('/filtro/tipos', [FilterController::class, 'types'])->name('types');
        Route::post('/filtro/cidades', [FilterController::class, 'cities'])->name('cities');
        Route::post('/filtro/quartos', [FilterController::class, 'bedrooms'])->name('bedrooms');
        Route::post('/filtro/suites', [FilterController::class, 'suites'])->name('suites');
        Route::post('/filtro/banheiros', [FilterController::class, 'bathrooms'])->name('bathrooms');
        Route::post('/filtro/garagens', [FilterController::class, 'garages'])->name('garages');
        Route::post('/filtro/preco-base', [FilterController::class, 'basePrice'])->name('base-price');
        Route::post('/filtro/preco-limite', [FilterController::class, 'limitPrice'])->name('limit-price');

        Route::any('/filtro', [FilterController::class, 'filter'])->name('filter');
        /** Property */
        Route::get('/imovel/{slug}', [WebPropertyController::class, 'index'])->name('property');

        /** Campaign */
        Route::get('/campanha/{slug}', [CampaignController::class, 'index'])->name('campaign');

        /** Cookie */
        Route::post('/cookie-consent', [CookieController::class, 'index'])->name('cookie.consent');
        Route::post('/cookie-consent-lp/{id}', [CookieController::class, 'landingPage'])->name('cookie.consent-lp');
    });
});

Auth::routes([
    'register' => false,
]);
