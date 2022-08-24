<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $statuses = get_class_constants(\App\Enums\CategoryStatuses::class);

        Schema::create('categories', function (Blueprint $table) use ($statuses) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->tinyInteger('order')->default(0);
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->enum('status', $statuses)->default(\App\Enums\CategoryStatuses::INACTIVE);
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
        Schema::dropIfExists('categories');
    }
}
