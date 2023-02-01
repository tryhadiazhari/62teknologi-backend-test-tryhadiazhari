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
        Schema::create('business', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('alias')->nullable();
            $table->string('name')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_closed')->default(false);
            $table->string('url')->nullable();
            $table->string('review_count')->nullable();
            $table->string('rating')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('price')->nullable();
            $table->string('phone')->nullable();
            $table->string('display_phone')->nullable();
            $table->string('distance')->nullable();
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
        Schema::dropIfExists('business');
    }
};
