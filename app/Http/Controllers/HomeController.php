<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        // dd(1234);
        // $title = "Xin chào tất cả các bạn";
        // return view('home', ['title' => $title]);

        $data = [];
        $data['title'] = "Xin chào tất cả các bạn";
        $data['text'] = "<u>Lớp WD18316</u>";
        $data['dataArr'] = [
            'Item 1',
            'Item 2',
            'Item 3',
        ];
        return view('home', $data);
    }

    public function index() {
        return view('clients.index');
    }
}
