<?php

Route::get('/', [
    'uses' => 'PostController@getBlogIndex',
    'as' => 'blog.index'
]);

Route::get('/blog', [
    'uses' => 'PostController@getBlogIndex',
    'as' => 'blog.index'
]);

Route::get('/blog/{post_id}&{end}', [
    'uses' => 'PostController@getPost',
    'as' => 'blog.post'
]);

Route::get('/blog/admin', function(){
   return view('errors.503');
});

/* Outras rotas */
Route::get('/about', function() {
    return view('front-end.outros.sobre');
})->name('about');

Route::get('/contact', [
    'uses' => 'ContactMessageController@getContatoIndex',
    'as' => 'contact'
]);

Route::post('/contact/sendemail', [
    'uses' => 'ContactMessageController@postSendMessage',
    'as' => 'contact.send'
]);

Route::get('/admin/login', [
   'uses' => 'AdminController@getLogin',
    'as'  => 'admin.login'
]);

Route::post('/admin/login', [
   'uses' => 'AdminController@postLogin',
    'as'  => 'admin.login'
]);

Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function() {
    Route::get('/', [
        'uses' => 'AdminController@getIndex',
        'as' => 'admin.index'
    ]);
    
    Route::get('/logut', [
        'uses' => 'AdminController@getLogout',
        'as'   => 'admin.logout'
    ]);
    
    Route::get('/blog/posts', [
        'uses' => 'PostController@getPostIndex',
        'as' => 'admin.blog.index'
    ]);
    
    Route::get('/blog/posts/create', [
        'uses' => 'PostController@getCreatePost',
        'as' => 'admin.blog.create_post'
    ]);

    Route::post('/blog/post/create', [
        'uses' => 'PostController@postCreatePost',
        'as' => 'admin.blog.post.create'
    ]);
    
    Route::get('/blog/post/{post_id}&{end}', [
        'uses' => 'PostController@getPost',
        'as' => 'admin.blog.post'
    ]);
    
    Route::get('/blog/posts/{post_id}/edit', [
        'uses' => 'PostController@getUpdatePost',
        'as' => 'admin.blog.post.edit'
    ]);
    
    Route::post('/blog/post/update', [
        'uses' => 'PostController@postUpdatePost',
        'as' => 'admin.blog.post.update'
    ]);
    
    Route::get('/blog/post/{post_id}/delete', [
       'uses' => 'PostController@getDeletePost',
        'as' => 'admin.blog.post.delete'
    ]);
    
    /*Categories routes*/
    
    Route::get('/blog/categories', [
        'uses' => 'CategoryController@getCategoryIndex',
        'as' => 'admin.blog.categories'
    ]);
    
    Route::post('/blog/category/create', [
        'uses' => 'CategoryController@postCreateCategory',
        'as' => 'admin.blog.category.create'
    ]);
    
    Route::post('blog/categories/update', [
        'uses' => 'CategoryController@postUpdateCategory',
        'as' => 'admin.blog.category.update'
    ]);
    
    Route::get('/blog/category/{category_id}/delete', [
       'uses' => 'CategoryController@getDeleteCategory',
        'as' => 'admin.blog.category.delete'
    ]);
    
    Route::get('/blog/contact/messages', [
       'uses' => 'ContactMessageController@getContactMessageIndex',
        'as'  => 'admin.contact.index'
    ]);
    
    Route::get('/contact/message/{message_id}/delete', [
       'uses' => 'ContactMessageController@getDeleteMessage',
       'as'   => 'admin.contact.delete'
    ]);
});
