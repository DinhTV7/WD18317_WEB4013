<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    // Sử dụng khi dùng Raw Query hoặc Query Builder
    // public $san_pham;

    // public function __construct()
    // {
    //     $this->san_pham = new SanPham();
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sử dụng khi dùng Raw Query hoặc Query Builder
        // Lấy dữ liệu của sản phẩm
        // $listSanPham = $this->san_pham->getList();

        // Sử dụng Eloquent
        $listSanPham = SanPham::get();

        $title = "Danh sách sản phẩm";

        return view('admins.sanpham.index', compact('title', 'listSanPham'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd("Đây là create resource");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Phương thức mới
    public function test() {
        dd("Đây là phương thức mới");
    }
}
