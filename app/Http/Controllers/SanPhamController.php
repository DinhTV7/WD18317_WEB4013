<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    // Nơi để tạo ra các hàm xử lý chức năng
    public function index() {
        // dd("Đây là trang SanPhamController");
        $title = "Danh sách sản phẩm";
        return view('sanpham.index', ['title' => $title]);
    }
}
