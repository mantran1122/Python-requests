<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AstrologyController extends Controller
{
    public function details()
    {
        // nếu cần load dữ liệu từ database thì làm ở đây
        return view('astrology.details');
    }
}
