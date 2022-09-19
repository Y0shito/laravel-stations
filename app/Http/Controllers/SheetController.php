<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function showSheetsPage()
    {
        $sheetRowA = Sheet::where('row', 'a')->get();
        $sheetRowB = Sheet::where('row', 'b')->get();
        $sheetRowC = Sheet::where('row', 'c')->get();

        return view('sheets', compact(['sheetRowA', 'sheetRowB', 'sheetRowC']));
    }
}
