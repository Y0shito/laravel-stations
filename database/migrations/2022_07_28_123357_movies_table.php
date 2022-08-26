<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement()->comment('ID');
            $table->text('title')->comment('映画タイトル');
            $table->text('image_url')->comment('画像URL');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE movies MODIFY created_at timestamp COMMENT '登録日時'");
        DB::statement("ALTER TABLE movies MODIFY updated_at timestamp COMMENT '更新日時'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
};
