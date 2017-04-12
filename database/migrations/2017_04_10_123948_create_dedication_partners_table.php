<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDedicationPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dedication_partners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('propose_id', false, true);
            $table->smallInteger('item', false, true);
            $table->string('name')->nullable();
            $table->string('territory')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->smallInteger('distance', false, true)->nullable();
            $table->string('file_partner_contract_ori')->nullable();
            $table->string('file_partner_contract')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dedication_partners');
    }
}
