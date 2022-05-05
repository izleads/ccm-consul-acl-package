<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateConsulTokensTable
 */
class CreateConsulTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consul_tokens', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('uuid');
            $table->string('secret');
            $table->string('description', 255);
            $table->json('roles');
            $table->json('policies');
            $table->boolean('local')->default(false);
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
        Schema::dropIfExists('consul_tokens');
    }
}
