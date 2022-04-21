<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToGigyaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gigya_users', function (Blueprint $table) {
            $table->foreign('user_id', 'gigya_users_user_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('users')
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
        Schema::table('gigya_users', function (Blueprint $table) {
            $table->dropForeign('gigya_users_user_id_foreign');
        });
    }
}
