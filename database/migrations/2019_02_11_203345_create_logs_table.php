<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('dog_id')->unsigned()->nullable();
            $table->string('dog_name')->nullable();
            $table->integer('media_id')->unsigned()->nullable();
            $table->string('log_usertype')->nullable();
            $table->integer('location_id')->unsigned();
            $table->string('location_other')->nullable();
            $table->integer('studentnum_id')->unsigned()->nullable();
            $table->integer('studentage_id')->unsigned()->nullable();
            $table->string('book_read')->nullable();
            $table->decimal('hours', 8, 2)->nullable();
            $table->smallInteger('pages')->nullable();
            $table->timestamp('log_date');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
