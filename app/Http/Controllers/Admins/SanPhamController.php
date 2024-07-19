<?php

namespace App\Http\Controllers\Admins;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use Illuminate\Support\Facades\Storage;

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
    // use Illuminate\Http\Request;
    public function index(Request $request)
    {
        // Sử dụng khi dùng Raw Query hoặc Query Builder
        // Lấy dữ liệu của sản phẩm
        // $listSanPham = $this->san_pham->getList();

        // Lấy dữ liệu từ form search
        $search = $request->input('search');
        $searchTrangThai = $request->input('searchTrangThai');

        // Sử dụng Eloquent
        $listSanPham = SanPham::query()
            ->when($search, function ($query, $search) {
                return $query->where('ma_san_pham', 'like', "%{$search}%")
                            ->orWhere('ten_san_pham', 'like', "%{$search}%");
            })
            ->when($searchTrangThai !== null, function ($query) use ($searchTrangThai) {
                return $query->where('trang_thai', '=', $searchTrangThai);
            })
            ->paginate(2);

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
    public function store(SanPhamRequest $request)
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

            // Xử lý ảnh
            if ($request->hasFile('hinh_anh')) {
                $filename = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            } else {
                $filename = null;
            }

            $params['hinh_anh'] = $filename;

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
        $title = "Chỉnh sửa thông tin sản phẩm";

        // Lấy thông tin chi tiết sản phẩm
        // Sử dụng Query Builder
        $sanPham = $this->san_pham->getDetailProduct($id);

        // Bằng Eloquent
        // $sanPham = SanPham::findOrFail($id);

        return view('admins.sanpham.update', compact('title', 'sanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SanPhamRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            // Sử dụng Eloquent
            // $sanPham = SanPham::findOrFail($id);

            // Sử dụng Query Builder
            $sanPham = $this->san_pham->getDetailProduct($id);

            // Xử lý hình ảnh
            if ($request->hasFile('hinh_anh')) {
                // Nếu có đẩy ảnh mới thì xóa ảnh cũ và lấy ảnh mới thêm vào DB
                if ($sanPham->hinh_anh) {
                    Storage::disk('public')->delete($sanPham->hinh_anh);
                }
                $params['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            } else {
                $params['hinh_anh'] = $sanPham->hinh_anh;
            }

            // Xử lý cập nhật thông tin
            // Eloquent
            // $sanPham->update($params);

            // Query Builder
            $this->san_pham->updateProduct($id, $params);

            return redirect()->route('sanpham.index')->with('success', 'Cập nhật sản phầm thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->isMethod('DELETE')) {
            // $sanPham = $this->san_pham->getDetailProduct($id);
            // if ($sanPham) {
            //     // Xóa bằng Query Builder
            //     $this->san_pham->deleteProduct($id);

            //     // Xóa hình ảnh sau khi xóa sản phẩm
            //     if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
            //         Storage::disk('public')->delete($sanPham->hinh_anh);
            //     }
            //     return redirect()->route('sanpham.index')->with('success', 'Xóa sản phầm thành công!');
            // }

            // Sử dụng Eloquent
            $sanPham = SanPham::query()->findOrFail($id);

            $sanPham->delete();

            if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
                Storage::disk('public')->delete($sanPham->hinh_anh);
            }

            return redirect()->route('sanpham.index')->with('success', 'Xóa sản phầm thành công!');
        }

        // Một số hàm sử dụng khi xóa mềm
        // Hàm hiển thị toàn bộ sản phẩm đã xóa mềm (Thùng rác)
        // $listSanPham = SanPham::query()->onlyTrashed()->get();

        // Hàm hoàn tác sản phẩm đã xóa mềm
        // $sanPham->restore();

        // Hàm xóa vĩnh viễn khi đã xóa mềm
        // $sanPham->forceDelete();
    }

    // Phương thức mới
    public function test()
    {
        dd("Đây là phương thức mới");
    }
}
