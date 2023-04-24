<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PupilController;

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
})->name('top');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

require __DIR__ . '/auth.php';

Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['verified'])->group(function () {
    Route::get('post/mycomment', [PostController::class, 'mycomment'])->name('post.mycomment');
    Route::resource('post', PostController::class);

    Route::post('post/comment/store', [CommentController::class, 'store'])->name('comment.store');

    Route::get('reply/nice/{post}', [NiceController::class, 'nice'])->name('nice');
    Route::get('reply/unnice/{post}', [NiceController::class, 'unnice'])->name('unnice');

    Route::get('profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware(['can:admin'])->group(function () {
        Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
        Route::delete('profile/{user}', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::resource('pupil', PupilController::class);
    });
});
