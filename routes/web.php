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

// Route::get('/', function () {
//     return view('pages.index');
// });
Route::get('/', 'HelloController@index');
Route::get('view/posts/{id}', 'HelloController@showpost');
Route::get(md5('/contactus'), 'HelloController@contact')->name('contact');
Route::get(md5('/aboutus'), 'HelloController@about')->name('about');

//category crud are here=====

Route::get(md5('add/category'), 'BoloController@AddCategory')->name('add.category');
Route::post('store/category', 'BoloController@StoreCategory')->name('store.category');
Route::get('all/category', 'BoloController@AllCategory')->name('all.category');
Route::get('all/category', 'BoloController@AllCategory')->name('all.category');
Route::get('view/category/{id}', 'BoloController@ViewCategory');
Route::get('delete/category/{id}', 'BoloController@DeleteCategory');
Route::get('edit/category/{id}', 'BoloController@EditCategory');
Route::post('update/category/{id}', 'BoloController@UpdateCategory');


Route::get('/category', 'CategoryController@Categories')->name('categories');
Route::get('add/catagory', 'CategoryController@AddCategories')->name('add.catagory');
Route::get('all/catagory', 'CategoryController@AllCategories')->name('all.catagory');
Route::get('view/catagory/{id}', 'CategoryController@ViewCategories');
Route::get('edit/catagory/{id}', 'CategoryController@EditCategories');
Route::post('update/catagory/{id}', 'CategoryController@UpdateCategories');
Route::get('delete/catagory/{id}', 'CategoryController@deleteCategories');
Route::post('store/catagory', 'CategoryController@StoreCategories')->name('store.catagory');

//post crud are here====

Route::get('blog/posts', 'BlogController@BlogPosts')-> name('blog.posts');
Route::get('add/posts', 'BlogController@AddPosts')-> name('add.posts');
Route::get('single/posts/{id}', 'BlogController@SinglePosts');
Route::get('edit/posts/{id}', 'BlogController@EditPosts');
Route::post('update/posts/{id}', 'BlogController@UpdatePosts');
Route::get('delete/posts/{id}', 'BlogController@DeletePosts');
Route::post('store/posts', 'BlogController@StorePosts')->name('store.posts');

//posts crud are here=====

Route::get('/posts', 'PostController@writePost')->name('write.post');
Route::post('store/post', 'PostController@store')->name('store.post');
Route::get('all/post','PostController@show')->name('all.post');
Route::get('view/post/{id}', 'PostController@postshow');
Route::get('edit/post/{id}', 'PostController@edit');
Route::post('update/post/{id}', 'PostController@update');
Route::get('delete/post/{id}', 'PostController@destroy');

//post image crud

Route::get('image/post', 'ImagePostController@index')->name('imagepost');
Route::post('store/imagepost', 'ImagePostController@store')->name('storeimagepost');
Route::get('all/imagepost', 'ImagePostController@show')->name('allimagepost');