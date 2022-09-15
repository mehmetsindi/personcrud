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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            $table->string('address' , 500);
            $table->string('post_code' , 15)->nullable();
            $table->string('city_name' , 50);
            $table->string('country_name' , 50);

            $table->string('person_slug');

            $table->enum('is_active', [1,0]);
            $table->enum('is_deleted', [1,0])->default(0);

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('person_slug')->references('slug')->on('person');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
};
