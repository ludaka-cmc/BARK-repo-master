<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToDogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dogs', function (Blueprint $table) {
            $table->foreign('volunteer_id', 'dogs_volunteer_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('volunteers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('media_id', 'dogs_media_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('media')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dogs', function (Blueprint $table) {
            $table->dropForeign('dogs_volunteer_id_foreign');
            $table->dropForeign('dogs_media_id_foreign');
        });
    }
}
