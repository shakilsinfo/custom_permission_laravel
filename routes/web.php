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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
Route::group(['middleware'=>['auth','roleWisePermission']],function(){
	Route::resource('dashboard', 'HomeController');	
	Route::resource('product', 'ProductController');	
	Route::resource('category', 'CategoryController');	
	Route::resource('blog', 'BlogController');	
	Route::resource('user-role', 'UserRoleController');	
	Route::resource('all-controller-list', 'GetControllerNameController');	
	Route::resource('about-us', 'AboutUsController');	
});

