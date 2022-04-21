<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->foreign('user_id', 'volunteers_user_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('users')
                ->onUpdate('cascade');

            $table->foreign('state_id', 'volunteers_state_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('states')
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
        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropForeign('volunteers_user_id_foreign');
            $table->dropForeign('volunteers_state_id_foreign');
        });
    }
}
