<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function showSheets(Request $request, $movie_id, $schedule_id)
    {
        if (empty($request->date)) {
            abort(400);
        }

        $sheetRowA = Sheet::where('row', 'a')->get();
        $sheetRowB = Sheet::where('row', 'b')->get();
        $sheetRowC = Sheet::where('row', 'c')->get();

        return view('reserve_sheet', compact(['sheetRowA', 'sheetRowB', 'sheetRowC']));
    }
}
