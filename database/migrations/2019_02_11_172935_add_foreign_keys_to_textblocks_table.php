<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\Log;

class AddForeignKeysToTextblocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('textblocks', function (Blueprint $table) {
            $table->foreign('page_id', 'textblocks_page_id_foreign')
                ->unsigned()
                ->references('id')
                ->on('pages')
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
        Schema::table('textblocks', function (Blueprint $table) {
            $table->dropForeign('textblocks_page_id_foreign');
        });
    }
}
