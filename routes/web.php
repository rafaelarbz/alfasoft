<?php

use App\Http\Controllers\Contact;
use App\Http\Controllers\People;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [People::class, 'index'])->name('index');

Route::prefix('people')->group(function (){
    Route::get('/new', [People::class, 'new'])->name('new');
    Route::get('/{id}/details', [People::class, 'details'])->name('details');
    Route::get('/{id}/edit', [People::class, 'details'])->name('edit');

    Route::post('/create', [People::class, 'create']);
    Route::put('/update/{id}', [People::class, 'update']);
    Route::delete('/delete/{id}', [People::class, 'delete']);

    Route::prefix('contact')->group(function (){
        Route::get('/{id}/new', [Contact::class, 'new'])->name('new-contact');
        Route::get('/{id}/edit', [Contact::class, 'edit'])->name('edit-contact');
    
        Route::post('/create/{id}', [Contact::class, 'create']);
        Route::put('/update/{id}', [Contact::class, 'update']);
        Route::delete('/delete/{id}', [Contact::class, 'delete']);
    });

});