<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('movies', function (Blueprint $table) {
            $table->integer('published_year')->after('image_url')->comment('公開年');
            $table->tinyInteger('is_showing')->default(false)->after('published_year')->comment('上映中かどうか');
            $table->text('description')->after('is_showing')->comment('概要');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn(['published_year', 'is_showing', 'description']);
        });
    }
};
