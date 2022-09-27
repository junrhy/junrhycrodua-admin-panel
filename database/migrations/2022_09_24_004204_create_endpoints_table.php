<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endpoints', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('api_source');
            $table->string('endpoint_url');
            $table->longText('auth');
            $table->longText('headers');
            $table->longText('body');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endpoints');
    }
};
