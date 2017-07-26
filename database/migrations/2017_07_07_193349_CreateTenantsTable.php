<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->boolean('has_image')->default(0);
            $table->integer('floor');
            $table->integer('unit');
            $table->unsignedInteger('building_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });    

        Schema::table('tenants', function (Blueprint $table) {

            $table->foreign('building_id')
                  ->references('id')
                  ->on('buildings')
                  ->onDelete('set null')
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
        //
        Schema::dropIfExists('tenants');
    }
}
