<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable;
            $table->string('slug')->nullable;
            $table->text('detail')->nullable;
            $table->integer('teacher_id');
            $table->string('thumbnail')->nullable;
            $table->float('price')->default(0);
            $table->float('sale_price')->default(0);
            $table->string('code', 100)->nullable;
            $table->float('durations')->default(0);
            $table->boolean('is_document')->default(0);
            $table->text('supports')->nullable;
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('courses');
    }
};
