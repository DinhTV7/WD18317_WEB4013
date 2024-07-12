<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    // Sử dụng khi dùng Raw Query hoặc Query Builder
    public $san_pham;

    public function __construct()
    {
        $this->san_pham = new SanPham();
    }
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
        $title = "Thêm sản phẩm";

        return view('admins.sanpham.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Xem dữ liệu đẩy lên
        // $params = $request->post();
        // dd($params);

        if ($request->isMethod('POST')) {
            // Cách 1:
            // $params = $request->post();
            // unset($params['_token']);

            // Cách 2:
            $params = $request->except('_token');
            // dd($params);

            // Sử dụng Query Builder
            // $this->san_pham->createProduct($params);

            // Sử dụng Eloquent
            SanPham::create($params);

            // Sau khi thêm sẽ quay về trang danh sách và hiển thị
            // thông báo thành công

            return redirect()->route('sanpham.index')->with('success', 'Thêm sản phầm thành công!');
        }
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
