<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->foreign('user_id', 'logs_user_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('users')
                ->onUpdate('cascade');

            $table->foreign('location_id', 'logs_location_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('locations')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('dog_id', 'logs_dog_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('dogs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('studentnum_id', 'logs_studentnum_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('studentnums')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('studentage_id', 'logs_studentage_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('studentages')
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
        Schema::table('logs', function (Blueprint $table) {
            // $table->dropForeign('logs_user_id_foreign');
            $table->dropForeign('logs_location_id_foreign');
            $table->dropForeign('logs_studentnum_id_foreign');
            $table->dropForeign('logs_studentage_id_foreign');
        });
    }
}
