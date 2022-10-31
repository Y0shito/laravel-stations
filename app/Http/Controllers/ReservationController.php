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

        $reservedDate = $request->date;
        $sheetRowA = Sheet::where('row', 'a')->get();
        $sheetRowB = Sheet::where('row', 'b')->get();
        $sheetRowC = Sheet::where('row', 'c')->get();

        return view('reserve_sheet', compact(['sheetRowA', 'sheetRowB', 'sheetRowC', 'reservedDate', 'movie_id', 'schedule_id']));
    }

    public function showReserveCreate(Request $request, $movie_id, $schedule_id)
    {
        if (empty($request->date) or empty($request->sheetId)) {
            abort(400);
        }

        // dd($request->sheetId, $request->date, $movie_id, $schedule_id);

        return view('reserve_create');
    }
}
