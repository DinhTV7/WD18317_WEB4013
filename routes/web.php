<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admins\SanPhamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Sử dụng Route để trỏ đến view
// Route::get('/hello', function () {
//     return view('xinchao');
// });

// Route::view('/hello', 'xinchao');

// Truyền dữ liệu sang view
// Route::get('/hello', function () {
//     $title = "Thầy Định đẹp trai";
//     $text = "Đẹp trai nhất Fpoly";
//     return view('xinchao', ['title' => $title, 'text' => $text ]);
// });

// Route::view('/hello', 'xinchao', [
//     'title' => 'Hi hi xin chào',
//     'text' => 'Chào bây by!',
// ]);

// Tạo 1 route trỏ đến 1 hàm trong controller
// Route::get('/home', [HomeController::class, 'home']);

Route::get('/client', [HomeController::class, 'index']);

// Route resouce
Route::get('sanpham/test', [SanPhamController::class, 'test'])->name('sanpham.test');
Route::resource('sanpham', SanPhamController::class);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
