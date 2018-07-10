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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){

	Route::get('/login','Admin\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login','Admin\Auth\LoginController@login')->name('admin.login.submit');


	Route::post( 'logout', 'Admin\Auth\LoginController@logout' )->name( 'admin.logout' );

	Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
	Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

});

Route::group(['namespace'=>'Admin','middleware'=>'auth:admin','prefix'=>'admin'],function () {

	// Users Routes
	Route::resource('user','UserController');
	// Roles Routes
	Route::resource('role','RoleController');
	// Permission Routes
	Route::resource('permission','PermissionController');
	// Post Routes
	Route::resource('post','PostController');
	// Tag Routes
	Route::resource('tag','TagController');
	// Category Routes
	Route::resource('category','CategoryController');

});


Route::get( 'img/{path}', function ( $path, League\Glide\Server $server, Illuminate\Http\Request $request ) {
	$server->outputImage( $path, $request->all() );
} )->where( 'path', '.+' );