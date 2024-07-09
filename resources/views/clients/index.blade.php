{{-- extends dùng đề kế thừa Layout --}}
@extends('layouts.client')

@section('title')
    Trang client
@endsection

@section('css')
    {{-- Nơi viết các CSS hoặc đường dẫn CSS dùng riêng --}}
    <style>
        
    </style>
    <link rel="stylesheet" href="{{ asset('assets/clients/css/index.css') }}">
@endsection

{{-- section dùng để định nghĩa nội dung của section --}}
@section('content')
    <h1 class="text-danger bg-info">Đây là trang client</h1>
    <p>Chào mừng đến với bình nguyên vô tận</p>
    <button onclick="submit()">Submit</button>
@endsection

@section('js')
    {{-- Nơi viết JS hoặc đường dẫn JS dùng riêng --}}
    <script>
        function submit() {
            alert(1234);
        }
    </script>

    <script src=""></script>
@endsection
