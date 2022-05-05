<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateConsulRolesTable
 */
class CreateConsulRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consul_roles', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('uuid');
            $table->string('name', 64);
            $table->string('description', 255);
            $table->json('policies');
            $table->timestamps();
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
        Schema::dropIfExists('consul_roles');
    }
}
