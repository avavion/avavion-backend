<?php

use App\Enums\UserRolesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('username', 64);
            $table->string('email', 256);
            $table->string('password', 256);
            $table->timestamp('email_verified_at')->nullable();

            $table->enum('role', UserRolesEnum::getRoleArrayValues())->default(UserRolesEnum::USER->value);

            $table->rememberToken();

            $table->unique(['username', 'email']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
