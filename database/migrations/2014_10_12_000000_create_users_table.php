<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userRoles = get_class_constants(\App\Enums\UserRoles::class);
        $userStatuses = get_class_constants(\App\Enums\UserStatuses::class);

        Schema::create('users', function (Blueprint $table) use ($userRoles, $userStatuses) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', $userRoles)->default(\App\Enums\UserRoles::USER);
            $table->string('phone')->nullable();
            $table->string('bio')->nullable();
            $table->string('profile_photo')->nullable();
            $table->enum('status', $userStatuses)->default(\App\Enums\UserStatuses::INACTIVE);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
