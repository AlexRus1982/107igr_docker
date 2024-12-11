<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get  ('/',                     [ApiController::class, 'index'])                      ->name('api.test.page');
Route::get  ('/categories',           [ApiController::class, 'getCategories'])              ->name('api.get.categories');
Route::post ('/category/info',        [ApiController::class, 'getCategoryInfo'])            ->name('api.get.category.info');
Route::get  ('/categories/simple',    [ApiController::class, 'getCategoriesSimple'])        ->name('api.get.categories.simple');

Route::get  ('/tags',                 [ApiController::class, 'getTags'])                    ->name('api.get.tags');

Route::get  ('/apps',                 [ApiController::class, 'getApps'])                    ->name('api.get.apps');
Route::get  ('/app/{id}',             [ApiController::class, 'getAppById'])                 ->name('api.get.app.by.id');

Route::get  ('/pages',                [ApiController::class, 'getPages'])                   ->name('api.get.pages');
Route::get  ('/page/{id}',            [ApiController::class, 'getPageById'])                ->name('api.get.page.by.id');

Route::get  ('/blogs',                [ApiController::class, 'getBlogs'])                   ->name('api.get.blogs');
Route::get  ('/comments',             [ApiController::class, 'getComments'])                ->name('api.get.Comments');

Route::get  ('/questionsAndAnswers',  [ApiController::class, 'getQuestionsAndAnswers'])     ->name('api.get.QuestionsAndAnswers');
Route::post ('/questionsAndAnswers',  [ApiController::class, 'setQuestionsAndAnswers'])     ->name('api.set.QuestionsAndAnswers');

Route::post ('/apps/activity',        [ApiController::class, 'setAppsActivity'])            ->name('api.set.apps.activity');
Route::post ('/apps/update',          [ApiController::class, 'dataAppsUpdate'])             ->name('api.data.apps.update');
Route::post ('/apps/tags',            [ApiController::class, 'getAppsTags'])                ->name('api.get.apps.tags');
Route::post ('/apps/delete',          [ApiController::class, 'deleteApp'])                  ->name('api.delete.app');

Route::post ('/categories/orders',    [ApiController::class, 'setCategoriesOrders'])        ->name('api.set.categories.order');
Route::post ('/categories/delete',    [ApiController::class, 'deleteCategory'])             ->name('api.delete.category');

Route::post ('/pages/update',         [ApiController::class, 'dataPagesUpdate'])            ->name('api.data.pages.update');

Route::post ('/upload/image',         [ApiController::class, 'uploadImage'])                ->name('api.upload.image');

Route::post ('/gigachat',             [ApiController::class, 'gigaChat'])                   ->name('api.gigaChat');

// ГигаЧат генерация описания
Route::get  ('/cron/start',           [ApiController::class, 'cronStart'])                  ->name('api.cronStart');

// ГигаЧат генерация комментария
Route::get  ('/cron/start/comment',   [ApiController::class, 'cronStartComment'])           ->name('api.cronStart.Comment');

// Загрузка приложения на сервер
Route::post  ('/upload/app',           [ApiController::class, 'uploadStartApp'])            ->name('api.uploadStart.App');
Route::get   ('/upload/app/progress',  [ApiController::class, 'uploadAppProgress'])         ->name('api.uploadApp.Progress');
