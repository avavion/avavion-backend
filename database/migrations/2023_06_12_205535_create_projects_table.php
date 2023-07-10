<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('content')->nullable();
            $table->string('url');
            $table->boolean('is_published')->default(false);
            $table->integer('stars')->default(0);
            $table->json('topics')->nullable();
            $table->string('system');
            $table->string('instance_id')->nullable();
            $table->timestamp('created')->useCurrent();

            $table->index(['instance_id', 'system']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
