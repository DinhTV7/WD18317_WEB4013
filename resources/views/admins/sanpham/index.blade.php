{{-- extends dùng đề kế thừa Layout --}}
@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="card">
        <h4 class="card-header">{{ $title }}</h4>
        <div class="card-body">
            {{--  --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('sanpham.create') }}" class="btn btn-success mb-3">Thêm sản phẩm</a>
                <form action="{{ route('sanpham.index') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <select name="searchTrangThai" class="form-select">
                            <option value="" selected>Chọn trạng thái</option>
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                        <input type="text" class="form-control" name="search" placeholder="Tìm hiếm....">
                        <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
                    </div>
                </form>
            </div>
            {{--  --}}
            
            {{-- Hiển thị thông báo --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Ngày nhập</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </thead>
                <tbody>
                    @foreach ($listSanPham as $index => $sanPham)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ Storage::url($sanPham->hinh_anh) }}" alt="Hình ảnh sản phẩm" width="150px">
                            </td>
                            <td>{{ $sanPham->ma_san_pham }}</td>
                            <td>{{ $sanPham->ten_san_pham }}</td>
                            <td>{{ $sanPham->gia }}</td>
                            <td>{{ $sanPham->so_luong }}</td>
                            <td>{{ $sanPham->ngay_nhap }}</td>
                            <td>{{ $sanPham->mo_ta }}</td>
                            <td>{{ $sanPham->trang_thai == 1 ? 'Hiển thị' : 'Ẩn' }}</td>
                            <td>
                                <a href="{{ route('sanpham.edit', $sanPham->id) }}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('sanpham.destroy', $sanPham->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Bạn có đồng ý xóa không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $listSanPham->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@section('js')
@endsection
