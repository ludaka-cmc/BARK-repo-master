<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTooltipTextToCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certifications', function (Blueprint $table) {
            $table->text('tooltip_text')->nullable()->after('url');
        });
    }

    public function down()
    {
        Schema::table('certifications', function (Blueprint $table) {
            $table->dropColumn('tooltip_text');
        });
    }
}
