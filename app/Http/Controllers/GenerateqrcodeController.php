<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateqrcodeController extends Controller
{
    public function index()
    {
        $url="http://127.0.0.1:8000";
        return view('Qrcode.qrcode',compact('url'));
    }

}
