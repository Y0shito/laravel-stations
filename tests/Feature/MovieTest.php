<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieTest extends TestCase
{
    // private function assertMovieCount(int $count): void
    // {
    //     $movieCount = Movie::count();
    //     $this->assertEquals($movieCount, $count);
    // }

    public function testCountTest(): void
    {
        // $this->assertMovieCount(0);
        $this->assertEquals(1, Movie::count());
    }
}
