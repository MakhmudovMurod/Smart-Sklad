<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Ingredients
    Route::resource('ingredients', 'IngredientsController');
    Route::post('replenish/{id}', 'IngredientsController@replenishReserve')->name('ingredients.replenish.reserve');

    // Formulas
    Route::resource('formulas', 'FormulasController');

    // Products
    Route::resource('products', 'ProductsController');

    //Reports
    Route::resource('reports', 'ReportsController');

    //Incomes
    Route::get('incomes', 'IncomesController@index')->name('income.index');
    Route::delete('incomes/{id}','IncomesController@destroy')->name('income.delete');
    Route::post('incomes', 'IncomesController@filter')->name('income.filter');

    //Outcomes
    Route::get('outcomes', 'OutcomesController@index')->name('outcome.index');
    Route::delete('outcomes/{id}', 'OutcomesController@destroy')->name('outcome.delete');
    Route::post('outcomes', 'OutcomesController@filter')->name('outcome.filter');


    // Global Units
    Route::get('units', 'GlobalUnitsController@create')->name('global_units');
    Route::post('units', 'GlobalUnitsController@store')->name('unit');
    Route::delete('units/{id}', 'GlobalUnitsController@destroy')->name('unit.delete');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
