{{-- 
    - Blade là một Templade Engine được cung cấp
        bởi Laravel
    - Các file Blade View có phần mở rộng là
    .blade.php và được lưu trữ trong resources/views
--}}
<h1>Đây là trang chủ</h1>

{{-- Cách hiển thị dữ liệu --}}
<h2><?= $title ?></h2>

<h2>{{ $title }}</h2>

<h3>{{ $text }}</h3>

{{-- Phiên dịch HTML --}}
<h3>{!! $text !!}</h3>

{{-- Vòng lặp for --}}
@for ($i = 1; $i <= 5; $i++)
    <p>Phần tử: {{ $i }}</p>
@endfor
<hr>
{{-- foreach trong blade --}}
@foreach ($dataArr as $item)
    <p>Item: {{ $item }}</p>
@endforeach
<hr>

{{-- forelse trong blade --}}
@forelse ($dataArr as $item)
    <p>Item: {{ $item }}</p>
@empty
    <p>Chưa có dữ liệu nào được thêm vào</p>
@endforelse

{{-- Câu lệnh rẽ nhánh --}}
@php
    // Viết các đoạn mã PHP vào đây

    $flag = true;
@endphp
{{-- Câu lệnh if --}}
@if ($flag)
    <p>Điều kiện đúng</p>
@endif

{{-- Câu lệnh if-else --}}
@if ($flag)
    <p>Điều kiện đúng</p>
@else
    <p>Điều kiện sai</p>
@endif

{{-- Câu lệnh if-elseif --}}
{{-- @if ($dieu_kien_1)
    <p>Điều kiện đúng</p>
@elseif ($dieu_kien_2)
    <p>Điều kiện sai</p>
@elseif ($dieu_kien_3)
    <p>Điều kiện sai</p>
@endif --}}
