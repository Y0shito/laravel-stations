<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Movie;
use App\Models\Sheet;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function showSheets(Request $request, $movie_id, $schedule_id)
    {
        if (empty($request->date)) {
            abort(400);
        }

        $reservedDate = $request->date;

        $sheets = Sheet::checkReservation($schedule_id)->get();

        return view('reserve_sheet', compact(['sheets', 'reservedDate', 'movie_id', 'schedule_id']));
    }

    // 上記だと予約日を変数に入れ、compactへ格納しているが、項目が多いと冗長になる
    // なら複数の値が格納されているrequestをまんま変数に入れcompactへ突っ込み、view側で$変数名->movie_idの方が省コードになる？
    // ただしここではなんの値が格納されているか不明（送られてきたrequestの大本をたどる必要がある）なため、不親切？
    // また必要以上の値がrequestに入っており、悪意あれば引き出せてしまう？
    // しかしviewでは$変数名->movie_idのようになんの値かはわかる

    public function showReserveCreate(Request $request, $movie_id, $schedule_id)
    {
        if (empty($request->date) or empty($request->sheetId)) {
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
                'date' => $request->date,
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
                ->route('reserveSheet', ['movie_id' => $movieId, 'schedule_id' => $request->schedule_id, 'date' => $request->date])
                ->with(['message' => 'その座席はすでに予約済みです']);
        }
    }

    public function showReservations()
    {
        // テスト時有効にする
        // $reservations = Reservation::notReleases()->with(['sheet', 'schedule.movie'])->get();
        $reservations = Reservation::with(['sheet', 'schedule.movie'])->get();
        return view('admin_reservations', compact('reservations'));
    }

    public function showReservationsCreate()
    {
        $schedules = Schedule::with('movie')->get();
        $sheets = Sheet::all();
        $movies = Movie::all();
        return view('admin_reservations_create', compact('schedules', 'sheets', 'movies'));
    }

    public function adminReservationsStore(ReservationRequest $request, Reservation $value)
    {
        try {
            $reservation = [
                'date' => $request->date,
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
}
