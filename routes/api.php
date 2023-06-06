<?php

use App\Http\Controllers\Api\BbsController;
use App\Http\Controllers\Api\JWTAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [JWTAuthController::class, 'register'])->name('api.jwt.register');
Route::post('login', [JWTAuthController::class, 'login'])->name('api.jwt.login');
Route::get('unauthorized', function () {
    return response()->json([
        'status' => 'fail',
        'message' => '인증에 실패하였습니다.',
    ], 401);
})->name('api.jwt.unauthorized');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', [JWTAuthController::class, 'user'])->name('api.jwt.user');
    Route::get('refresh', [JWTAuthController::class, 'refresh'])->name('api.jwt.refresh');
    Route::get('logout', [JWTAuthController::class, 'logout'])->name('api.jwt.logout');
    Route::delete('leave', [JWTAuthController::class, 'leave'])->name('api.jwt.leave');
});

Route::group(
    [
        'prefix' => 'bbs',
        'as' => 'bbs.',
        'middleware' => ['auth:api'],
    ],
    function ($router) {
        Route::post('', [BbsController::class, 'addNewArticle'])->name('add-new-article');
        Route::delete('/{articleId}', [BbsController::class, 'deleteArticle'])->name('delete-article');
        Route::get('/{articleId}', [BbsController::class, 'getArticle'])->name('get-article');
        Route::get('', [BbsController::class, 'getArticleList'])->name('get-article-list');
        Route::post('/articles/{articleId}/comments', [BbsController::class, 'addNewComment'])->name('comments.add-new-comment');
        Route::delete('/articles/{articleId}/comments/{commentId}', [BbsController::class, 'deleteComment'])->name('comments.delete-comment');
    }
);
