<?php

use Illuminate\Http\Request;

// // // // // // // // // // // // // // // // // // // // // // // // // // //

Route::prefix('page')->group(function(){
    Route::post('register', 'Api\Page\AuthController@register');
    Route::post('update', 'Api\Page\AuthController@update');
    Route::post('login', 'Api\Page\AuthController@login');

    Route::post('send', 'Api\Page\ContactController@send');
});

// // // // // // // // // // // // // // // // // // // // // // // // // // //

Route::prefix('admin')->group(function(){
    Route::post('register', 'Api\Admin\AuthController@register');
    Route::post('update', 'Api\Admin\AuthController@update');
    Route::post('login', 'Api\Admin\AuthController@login');

    Route::middleware('auth:admin')->group(function(){
        Route::get('check', 'Api\Admin\AuthController@check');
        foreach(config('routes.list') as $s){
            Route::get($s, 'Api\Admin\\' . ucfirst($s).'Controller@'.$s);

            Route::post($s . '/save', 'Api\Admin\\' . ucfirst($s).'Controller@save');
            Route::post($s . '/remove/{id}', 'Api\Admin\\' . ucfirst($s).'Controller@remove');
            Route::post($s . '/update/{id}', 'Api\Admin\\' . ucfirst($s).'Controller@update');
            Route::get($s . '/get/{id}', 'Api\Admin\\' . ucfirst($s).'Controller@search');

            Route::post($s . '/remove-media', 'Api\Admin\\' . ucfirst($s).'Controller@removeMedia');
            Route::post($s . '/save-order', 'Api\Admin\\' . ucfirst($s).'Controller@saveOrder');
            Route::post($s . '/active-many', 'Api\Admin\\' . ucfirst($s).'Controller@activeMany');
            Route::post($s . '/remove-many', 'Api\Admin\\' . ucfirst($s).'Controller@removeMany');
        }
        Route::prefix('analytics')->group(function(){
            Route::get('', 'Api\Admin\AnalyticsController@fetch');
        });
    });
});

// // // // // // // // // // // // // // // // // // // // // // // // // // //

Route::get('login', function(){
    return response()->json([
        'status' => 'error',
        'message' => 'Unauthorized',
    ]);
})->name('login');
