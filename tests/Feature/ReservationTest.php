<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\Screen;
use App\Models\Reservation;
use App\Models\Schedule;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    private function createMovie(string $title): Movie
    {
        $movieId = Movie::insertGetId([
            'title' => $title,
            'image_url' => 'https://techbowl.co.jp/_nuxt/img/6074f79.png',
            'published_year' => 2000,
            'description' => '概要',
            'is_showing' => rand(0, 1),
        ]);
        return Movie::find($movieId);
    }

    private function createSchedule(int $movieId): Schedule
    {
        $scheduleId = Schedule::insertGetId([
            'movie_id' => $movieId,
            'screen_no' => $this->faker->numberBetween(1, 3),
            'start_time' => new CarbonImmutable(),
            'end_time' => new CarbonImmutable(),
        ]);
        return Schedule::find($scheduleId);
    }

    private function createReservation(): array
    {
        $movieId = $this->createMovie('タイトル')->id;
        $scheduleId = $this->createSchedule($movieId)->id;
        $reservationId = Reservation::insertGetId([
            'screening_date' => Schedule::find($scheduleId)->start_time->format('Y-m-d'),
            'schedule_id' => $scheduleId,
            'sheet_id' => 1,
            'email' => 'sample@exmaple.com',
            'name' => 'サンプル太郎',
        ]);

        return [$scheduleId, $reservationId];
    }

    // tests/Feature/LaravelStations/Station17/AdminReservationTest.phpより、Station18用のテストへ改修
    // use文およびテスト内のSheetをScreenへ
    // schedulesにscreen_noを追加したため、Scheduleへinsertされる箇所には'screen_no'を追加

    /**
     * @group station18
     */
    public function test管理者予約一覧が表示されているか(): void
    {
        $count = 12;
        for ($i = 0; $i < $count; $i++) {
            $movieId = $this->createMovie('タイトル' . $i)->id;
            Reservation::insert([
                'screening_date' => new CarbonImmutable('2050-01-01'),
                'schedule_id' => Schedule::insertGetId([
                    'movie_id' => $movieId,
                    'screen_no' => $this->faker->numberBetween(1, 3),
                    'start_time' => new CarbonImmutable('2050-01-01 00:00:00'),
                    'end_time' => new CarbonImmutable('2050-01-01 02:00:00'),
                ]),
                'sheet_id' => $i + 1,
                'email' => 'sample@exmaple.com',
                'name' => 'サンプル太郎',
            ]);
        }
        $response = $this->get('/admin/reservations/');
        $response->assertStatus(200);

        $reservations = Reservation::all();
        foreach ($reservations as $reservation) {
            $response->assertSee($reservation->screening_date->format('Y-m-d'));
            $response->assertSee($reservation->name);
            $response->assertSee($reservation->email);
            $response->assertSee(strtoupper($reservation->sheet->row . $reservation->sheet->column));
        }
    }

    /**
     * @group station18
     */
    public function test管理者予約一覧で上映終了の映画が非表示となっているか(): void
    {
        $count = 12;
        for ($i = 0; $i < $count; $i++) {
            $movieId = $this->createMovie('タイトル' . $i)->id;
            Reservation::insert([
                'screening_date' => new CarbonImmutable('2020-01-01'),
                'schedule_id' => Schedule::insertGetId([
                    'movie_id' => $movieId,
                    'screen_no' => $this->faker->numberBetween(1, 3),
                    'start_time' => new CarbonImmutable('2020-01-01 00:00:00'),
                    'end_time' => new CarbonImmutable('2020-01-01 02:00:00'),
                ]),
                'sheet_id' => $i + 1,
                'email' => 'sample@exmaple.com',
                'name' => 'サンプル太郎',
            ]);
        }
        $response = $this->get('/admin/reservations/');
        $response->assertStatus(200);

        $reservations = Reservation::all();
        foreach ($reservations as $reservation) {
            $response->assertDontSee($reservation->screening_date);
            $response->assertDontSee($reservation->name);
            $response->assertDontSee($reservation->email);
            $response->assertDontSee(strtoupper($reservation->sheet->row . $reservation->sheet->column));
        }
    }

    /**
     * @group station18
     */
    public function test管理者予約作成画面が表示されているか(): void
    {
        $response = $this->get('/admin/reservations/create');
        $response->assertStatus(200);
    }

    /**
     * @group station18
     */
    public function test管理者予約作成画面で予約が作成されるか(): void
    {
        $this->assertReservationCount(0);
        $movieId = $this->createMovie('タイトル')->id;
        $scheduleId = $this->createSchedule($movieId)->id;

        $response = $this->post('/admin/reservations/store', [
            'screening_date' => new CarbonImmutable('2050-01-01'),
            'movie_id' => $movieId,
            'schedule_id' => $scheduleId,
            'sheet_id' => Screen::first()->id,
            'name' => 'サンプル太郎',
            'email' => 'sample@techbowl.com',
        ]);
        $response->assertStatus(302);
        $this->assertReservationCount(1);
    }

    /**
     * @group station18
     */
    public function testRequiredバリデーションが設定されているか(): void
    {
        $this->assertReservationCount(0);
        $response = $this->post('/admin/reservations/store', [
            'screening_date' => '',
            'schedule_id' => null,
            'sheet_id' => null,
            'name' => '',
            'email' => '',
        ]);
        $response->assertStatus(302);
        $response->assertInvalid(['screening_date', 'schedule_id', 'sheet_id', 'name', 'email']);
        $this->assertReservationCount(0);
    }

    private function assertReservationCount(int $count): void
    {
        $reservationCount = Reservation::count();
        $this->assertEquals($reservationCount, $count);
    }

    // 予約内容編集画面(admin/reservations/{id}/pre-edit)を新造したため、テスト増設
    /**
     * @group station18
     */
    public function test予約内容編集画面が表示されているか(): void
    {
        list($scheduleId, $reservationId) = $this->createReservation();
        $response = $this->get('/admin/reservations/' . $reservationId . '/pre-edit');
        $response->assertStatus(200);
    }

    /**
     * @group station18
     */
    public function test管理者予約編集画面が表示されているか(): void
    {
        list($scheduleId, $reservationId) = $this->createReservation();

        $response = $this->post('/admin/reservations/' . $reservationId . '/edit', [
            'schedule_id' => $scheduleId,
            'name' => Reservation::find($reservationId)->name,
            'email' => Reservation::find($reservationId)->email,
        ]);

        $response->assertStatus(200);
    }

    /**
     * @group station18
     */
    public function test管理者予約編集画面で映画予約が更新されるか(): void
    {
        list($scheduleId, $reservationId) = $this->createReservation();

        $response = $this->patch('/admin/reservations/' . $reservationId, [
            'id' => $reservationId,
            'screening_date' => Schedule::find($scheduleId)->start_time->format('Y-m-d'),
            'schedule_id' => $scheduleId,
            'sheet_id' => 2,
            'name' => 'サン太郎',
            'email' => 'sample@techbowl.com',
        ]);
        $response->assertStatus(302);
        $updated = Reservation::find($reservationId);
        $this->assertEquals($updated->name, 'サン太郎');
        $this->assertEquals($updated->email, 'sample@techbowl.com');
        $this->assertEquals($updated->sheet_id, 2);
    }

    /**
     * @group station18
     */
    public function test更新時Requiredバリデーションが設定されているか(): void
    {
        list($scheduleId, $reservationId) = $this->createReservation();

        $response = $this->patch('/admin/reservations/' . $reservationId, [
            'id' => null,
            'screening_date' => '',
            'schedule_id' => null,
            'sheet_id' => null,
            'name' => '',
            'email' => '',
        ]);
        $response->assertStatus(302);
        $response->assertInvalid(['id', 'screening_date', 'schedule_id', 'sheet_id', 'name', 'email']);
    }

    /**
     * @group station18
     */
    public function test予約を削除できるか(): void
    {
        list($scheduleId, $reservationId) = $this->createReservation();
        $this->assertReservationCount(1);
        $response = $this->delete('/admin/reservations/' . $reservationId);
        $response->assertStatus(302);
        $this->assertReservationCount(0);
    }

    /**
     * @group station18
     */
    public function test削除対象が存在しない時404が返るか(): void
    {
        $response = $this->delete('/admin/reservations/1');
        $response->assertStatus(404);
    }
}
