<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
// category
Route::get('/All/Category','CategoryController@AllCat')->name('all.category');

Route::post('/Add/Category','CategoryController@AddCat')->name('store.cat');
Route::get('/Category/Edit/{id}','CategoryController@Edit');
Route::post('/Store/Category/{id}','CategoryController@Update');
Route::get('/Category/Delete/{id}','CategoryController@softdelete');
Route::get('/Cat/Data/Restore/{id}','CategoryController@RestoreData');
Route::get('/Cat/Data/P_Delete/{id}','CategoryController@PDelete');

// Brand
Route::get('/All/Brand','BrandController@AllBrand')->name('all.brand');
Route::post('/Add/Brand','BrandController@AddBrand')->name('add.brand');
Route::get('/Edit/Brands/{id}','BrandController@EditBrand');
Route::post('/Brand/Update/{id}','BrandController@Update');
Route::get('/Delete/Brands/{id}','BrandController@Delete');

// MultiImage

Route::get('/MultiImage/All','MultiImageController@Index')->name('all.multiImage');
Route::post('/MultiImage/Add','MultiImageController@AddMulti')->name('add.multi');
Route::get('/MultiImage/Delete/{id}','MultiImageController@Delete');

// User Profile
Route::get('/UserProfile/Show','UserProfileController@Index')->name('user.profile');
Route::post('/UserProfile/update','UserProfileController@AddProfile')->name('update.profile');

// Change Password

Route::get('/Change/Password','UserProfileController@ChangePassword')->name('change.password');
Route::post('/Change/Password/Action','UserProfileController@UpdatePass')->name('change.action');

