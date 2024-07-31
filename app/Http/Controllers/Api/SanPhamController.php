<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SanPhamResource;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        return SanPhamResource::collection($listSanPham);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->all();

            dd($params);

            if ($request->hasFile('hinh_anh')) {
                $filename = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
            } else {
                $filename = null;
            }

            $params['hinh_anh'] = $filename;

            $sanPham = SanPham::create($params);

            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        return new SanPhamResource($sanPham);
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
}
