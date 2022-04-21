<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('dog_id', 'notes_dog_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('dogs')
                ->onUpdate('cascade');

            $table->foreign('student_id', 'notes_student_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('students')
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
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign('notes_dog_id_foreign');
            $table->dropForeign('notes_student_id_foreign');
        });
    }
}
