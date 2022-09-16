<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function showSheetsPage()
    {
        return view('sheets');
    }
}
