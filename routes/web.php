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

Route::resource('blogposts','Blog\PostController')->names('blog.posts');

//Route::resource('rest','RestTestController')->names('restTest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Админка Блога
$groupData = [
    'manespace' => 'Blog\Admin',
    'prefix'    => 'admin'
];
Route::group($groupData, function () {
    // BlogCategory
    $methods = ['index', 'edit', 'store', 'update', 'create'];
    Route::resource('categories', 'CategoryController')->only($methods) ->names('blog.admin.categories');
});
