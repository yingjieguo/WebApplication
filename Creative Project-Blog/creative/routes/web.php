<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('contact','PagesController@getContact');
Route::get('about','PagesController@getAbout');
Route::get('/welcome','PagesController@getindex');
Route::get('/', 'WelcomeController@index');
Route::get('home','HomeController@index');
//Route::Controllers([
//    'auth'=>'Auth\AuthController',
 //   'password'=>'Auth\PasswordController']);
Route::get('/','PostController@index')->name('trytrytry');
Route::get('/try','Front@index');
//Route::get('/','Front@index');
Route::get('/products','Front@products');
Route::get('/products/details/{id}','Front@product_details')->name('get-blog');
Route::get('/products/categories','Front@product_categories');
Route::get('/products/brands','Front@product_brands');
Route::post('/blog','Front@blog');
Route::get('/blog/post/{id}','Front@blog_post');
Route::get('/contact-us','Front@contact_us');
Route::get('/login','Front@login');
Route::get('/logout','Front@logout');
Route::get('/cart','Front@cart');
Route::get('/checkout','Front@checkout');
Route::get('/search/{query}','Front@search');
Route::get('/hello','Hello@index');
Route::get('posts/newcreate','PostController@newcreate')->name('posts.newcreate');
Route::post('posts/newstore','PostController@newstore')->name('posts.newstore');
Route::resource('posts','PostController');
Route::resource('categories','CategoryController',['excpet'=>['create']]);
//comment
Route::post('comments/{post_id}',['uses'=>'CommentsController@store','as'=>'comments.store']);
//Route::get('/', function () 
  //  return view('home');
//});
Route::get('blade', function () {
    $drinks = array('Vodka','Gin','Brandy');
    return view('page',array('name' => 'The Raven','day' => 'Friday','drinks' => $drinks));
});
Route::get('/hello/{name}','Hello@show');
Auth::routes();

Route::get('/insert', function() {
    App\Category::create(array('name' => 'Music'));
    return 'category added';
});

Route::get('/read', function() {
    $category = new App\Category();
    
    $data = $category->all(array('name','id'));

    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '
';
    }
});

Route::get('/delete', function() {
    $category = App\Category::find(5);
    $category->delete();
    
    $data = $category->all(array('name','id'));

    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '
';
    }
});

Route::get('/update', function() {
    $category = App\Category::find(6);
    $category->name = 'HEAVY METAL';
    $category->save();
    
    $data = $category->all(array('name','id'));

    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '
';
    }
});

// Authentication routes...
Route::get('auth/login', 'Front@login')->name('trylogin');
Route::post('auth/login', 'Front@authenticate');
Route::get('auth/logout', 'Front@logout');




// Registration routes...
Route::post('/register', 'Front@register');

//Route::get('/home', 'HomeController@index');
