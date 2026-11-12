<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visitor_traffic', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_id', 64)->index();
            $table->string('session_id', 64)->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('method', 10)->default('GET');
            $table->string('path', 255)->index();
            $table->text('url');
            $table->text('referer')->nullable();
            $table->string('referer_domain', 150)->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('device_type', 30)->default('desktop')->index();
            $table->string('browser', 50)->nullable()->index();
            $table->string('os', 50)->nullable()->index();
            $table->string('country', 80)->nullable();
            $table->unsignedSmallInteger('status_code')->default(200);
            $table->boolean('is_bot')->default(false)->index();
            $table->timestamps();

            $table->index(['created_at', 'is_bot']);
            $table->index(['visitor_id', 'created_at']);
            $table->index(['path', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_traffic');
    }
};
