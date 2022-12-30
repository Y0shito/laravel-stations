<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `screens` VALUES
        (1, 1, 1,'a'),
        (2, 1, 2,'a'),
        (3, 1, 3,'a'),
        (4, 1, 4,'a'),
        (5, 1, 5,'a'),
        (6, 1, 1,'b'),
        (7, 1, 2,'b'),
        (8, 1, 3,'b'),
        (9, 1, 4,'b'),
        (10, 1, 5,'b'),
        (11, 1, 1,'c'),
        (12, 1, 2,'c'),
        (13, 1, 3,'c'),
        (14, 1, 4,'c'),
        (15, 1, 5,'c'),
        (16, 2, 1,'a'),
        (17, 2, 2,'a'),
        (18, 2, 3,'a'),
        (19, 2, 4,'a'),
        (20, 2, 5,'a'),
        (21, 2, 1,'b'),
        (22, 2, 2,'b'),
        (23, 2, 3,'b'),
        (24, 2, 4,'b'),
        (25, 2, 5,'b'),
        (26, 2, 1,'c'),
        (27, 2, 2,'c'),
        (28, 2, 3,'c'),
        (29, 2, 4,'c'),
        (30, 2, 5,'c'),
        (31, 3, 1,'a'),
        (32, 3, 2,'a'),
        (33, 3, 3,'a'),
        (34, 3, 4,'a'),
        (35, 3, 5,'a'),
        (36, 3, 1,'b'),
        (37, 3, 2,'b'),
        (38, 3, 3,'b'),
        (39, 3, 4,'b'),
        (40, 3, 5,'b'),
        (41, 3, 1,'c'),
        (42, 3, 2,'c'),
        (43, 3, 3,'c'),
        (44, 3, 4,'c'),
        (45, 3, 5,'c');");
    }
}
