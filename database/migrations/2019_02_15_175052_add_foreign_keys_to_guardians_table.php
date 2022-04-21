<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGuardiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guardians', function (Blueprint $table) {
            $table->foreign('program_id', 'guardians_program_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('programs')
                ->onUpdate('cascade');
        });

        Schema::table('guardians', function (Blueprint $table) {
            $table->foreign('state_id', 'guardians_state_id_foreign')
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
        Schema::table('guardians', function (Blueprint $table) {
            $table->dropForeign('guardians_program_id_foreign');
            $table->dropForeign('guardians_state_id_foreign');
        });
    }
}
