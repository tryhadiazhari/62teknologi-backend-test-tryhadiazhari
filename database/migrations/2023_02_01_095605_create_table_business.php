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
            $table->text('image_url')->nullable();
            $table->boolean('is_closed')->unsigned()->default(0);
            $table->text('url')->nullable();
            $table->integer('review_count')->unsigned()->default(0);
            // $table->integer('categories_id')->unsigned()->nullable();
            $table->double('rating')->default(0);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->enum('price', [1, 2, 3, 4])->default(1);
            $table->bigInteger('country_code')->unsigned()->default(0);
            $table->bigInteger('phone')->unsigned()->default(0);
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
