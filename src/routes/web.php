<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\WebController;

    #region pages routes ----------------------------------------------------------------------------------------------

    $pages = DB::table('pages')
    ->get();

    foreach ($pages as $page) {
        Route::get("/{$page->url}", fn() => view('main.info-page', ['page' => $page]))->name("{$page->url}.info.page");
    }

    #endregion pages routes -------------------------------------------------------------------------------------------

    Route::get('/',                             [WebController::class, 'index'])                 ->name('main.page');
    Route::get('/games',                        [WebController::class, 'categoriesGames'])       ->name('games.page');
    Route::get('/apps',                         [WebController::class, 'categoriesApps'])        ->name('apps.page');

    Route::get('/games/{url}',                  [WebController::class, 'urlPageGames'])          ->name('games.page.url');
    Route::get('/apps/{url}',                   [WebController::class, 'urlPageApps'])           ->name('apps.page.url');

    Route::get('/download/{url}',               [WebController::class, 'download'])              ->name('download.page.url');
    
    Route::get('/search',                       [WebController::class, 'search'])                ->name('search.page');

    Route::get('/podborka-programm',            fn() => view('main.podborka-programm'))          ->name('podborka-programm.page');
    Route::get('/instrukcii',                   fn() => view('main.instrukcii'))                 ->name('instrukcii.page');

    Route::get('/blogs',                        [WebController::class, 'blogs'])                 ->name('blogs.page');
    Route::get('/blogs/{url}',                  [WebController::class, 'blogPage'])              ->name('blog.page');

    Route::get('/admin-panel',                  fn() => view('admin.index'))->middleware('auth') ->name('admin.panel');
    Route::get('/admin-panel/{page}',           fn() => view('admin.index'))->middleware('auth') ->name('admin.panel.page');
    Route::get('/admin-panel/apps/edit',        fn() => view('admin.index'))->middleware('auth') ->name('admin.panel.apps.edit');
    Route::get('/admin-panel/apps/edit2',       fn() => view('admin.index'))->middleware('auth') ->name('admin.panel.apps.edit2');

    Route::get('/admin-panel/category/edit',    fn() => view('admin.index'))->middleware('auth') ->name('admin.panel.category.edit');
    Route::get('/admin-panel/page/edit',        fn() => view('admin.index'))->middleware('auth') ->name('admin.panel.page.edit');

    #region auth admin ------------------------------------------------------------------------------------------------
    // admin@ya.ru admin123456
    
    Auth::routes(['register' => false]);

    Route::get('/login',                    fn() => view('login'))                           ->name('login');
    Route::get('/logout',                   fn() => ActionsSystem::Action('Logout'))         ->name('logout');
    // Route::get('/register',                 fn() => view('register'))                        ->name('register');
    
    #endregion auth admin ---------------------------------------------------------------------------------------------

    #region sitemap requests ------------------------------------------------------------------------------------------

    Route::get('/sitemap',            [WebController::class, 'sitemap'])               ->name('sitemap');
    Route::get('/sitemap.xml',        [WebController::class, 'sitemap'])               ->name('sitemap');

    #endregion --------------------------------------------------------------------------------------------------------

?>