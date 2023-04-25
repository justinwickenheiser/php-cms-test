<?php

use Illuminate\Support\Facades\Route;
use GvsuWebTeam\Cms\Http\Controllers\SiteController;
use GvsuWebTeam\Cms\Http\Controllers\ContentController;
use GvsuWebTeam\Cms\Http\Controllers\AuthenticationController;

// All routes in this file are grouped with prefixed with `config('cms.admin.route-prefix')` --> 'cms5'
// All routes in this file have a route name starting with 'cms.admin.'
// This is all set in the cms.admin middleware is handled in the routes.php file.

Route::get('/login', [AuthenticationController::class, 'create'])->name('login');
Route::get('/logout', [AuthenticationController::class, 'destroy'])->name('logout');
// 'cms.admin.auth'
Route::group(['middleware' => ['cms.admin.auth'] ], function () {
	Route::get('/', function () {
		return redirect(route('site.index'));
	});
	Route::get('/site', [SiteController::class, 'index'])->name('site.index');
	Route::get('/{site:path}/content', [ContentController::class, 'index'])->name('site.content.index');
	// Route::get('/user', [UserController::class, 'index'])->name('user.index');
});