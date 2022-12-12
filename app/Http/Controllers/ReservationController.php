<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Movie;
use App\Models\Sheet;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Http\Requests\AdminCreateReservationRequest;
use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function showSheets(Request $request, $movie_id, $schedule_id)
    {
        $reservedDate = $request->screening_date;

        if (empty($reservedDate)) {
            abort(400);
        }

        $sheets = Sheet::checkReservation($schedule_id)->get();

        return view('reserve_sheet', compact(['sheets', 'reservedDate', 'movie_id', 'schedule_id']));
    }

    public function showReserveCreate(Request $request, $movie_id, $schedule_id)
    {
        if (empty($request->screening_date) or empty($request->sheetId)) {
            abort(400);
        }

        $checkReserved = Sheet::checkReservation($schedule_id)->find($request->sheetId);

        if ($checkReserved->reservations_count === 1) {
            abort(400);
        }

        $getSheetName = Sheet::find($request->sheetId, ['column', 'row']);

        return view('reserve_create', ['value' => $request, 'sheetName' => "{$getSheetName->row}-{$getSheetName->column}"]);
    }

    public function reserveStore(ReservationRequest $request, Reservation $value)
    {
        try {
            $reservation = [
                'screening_date' => $request->screening_date,
                'schedule_id' => $request->schedule_id,
                'sheet_id' => $request->sheet_id,
                'email' => $request->email,
                'name' => $request->name,
            ];

            $movieId = Schedule::whereId($request->schedule_id)->pluck('movie_id')->first();

            $value->reserveStoreOnModel($reservation);

            return redirect()
                ->route('movie', ['id' => $movieId])
                ->with(['message' => '予約が完了しました']);
        } catch (Exception $e) {
            return redirect()
                ->route('reserveSheet', ['movie_id' => $movieId, 'schedule_id' => $request->schedule_id, 'screening_date' => $request->screening_date])
                ->with(['message' => 'その座席はすでに予約済みです']);
        }
    }

    public function showReservations()
    {
        $reservations = Reservation::withoutReleased()->with(['sheet', 'schedule.movie'])->get();
        return view('admin_reservations', compact('reservations'));
    }

    public function showReservationsCreate()
    {
        $schedules = Schedule::with('movie')->get();
        $sheets = Sheet::all();
        $movies = Movie::all();
        return view('admin_reservations_create', compact('schedules', 'sheets', 'movies'));
    }

    public function adminReservationsStore(AdminCreateReservationRequest $request, Reservation $value)
    {
        try {
            $reservation = [
                'screening_date' => $request->screening_date,
                'schedule_id' => $request->schedule_id,
                'sheet_id' => $request->sheet_id,
                'email' => $request->email,
                'name' => $request->name,
            ];

            $value->reserveStoreOnModel($reservation);

            return redirect()
                ->route('adminReservations')
                ->with(['message' => '予約が完了しました']);
        } catch (Exception $e) {
            return redirect()
                ->route('adminReservations')
                ->with(['message' => 'その座席はすでに予約済みです']);
        }
    }

    public function showAdminReservationsEdit($id)
    {
        $reservation = Reservation::with('schedule.movie')->find($id);
        $schedules = Schedule::with('movie')->get();
        $sheets = Sheet::all();
        $movies = Movie::all();
        return view('admin_reservations_edit', compact('schedules', 'sheets', 'movies', 'reservation'));
    }

    public function reservationDelete(Request $request, Reservation $value)
    {
        $reservation = $value->reservationDeleteOnModel($request);
        return back();
    }
}
