<?php

use Illuminate\Support\Facades\Route;
use GvsuWebTeam\Cms\Http\Controllers\SiteController;
use GvsuWebTeam\Cms\Http\Controllers\ContentController;

// Route::group(['middleware' => ['auth'], 'prefix' => 'cms5'], function () {
Route::group(['prefix' => 'cms5'], function () {
	Route::get('/', function () {
		return redirect(route('cms.admin.site.index'));
	});
	Route::get('/site', [SiteController::class, 'index'])->name('cms.admin.site.index');
	Route::get('/{site:path}/content', [ContentController::class, 'index'])->name('cms.admin.site.content.index');
	// Route::get('/user', [UserController::class, 'index'])->name('cms.admin.user.index');
});