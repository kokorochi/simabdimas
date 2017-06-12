<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVarcharToTextAspectReviewProposesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_proposes_i', function (Blueprint $table) {
            $table->text('aspect')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_proposes_i', function (Blueprint $table) {
            $table->string('aspect', 255)->change();
        });
    }
}
