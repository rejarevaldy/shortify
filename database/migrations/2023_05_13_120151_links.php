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
        Schema::create('links', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title')->nullable();
            $table->string('link');
            $table->string('shorted_link')->unique();
            $table->foreignUuid('user_id');
            $table->foreignId('link_audit_id');
            $table->timestamps();
        });

        Schema::create('links_audit', function (Blueprint $table) {
            $table->id();
            $table->string('hit_count')->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
        Schema::dropIfExists('links_audit');
    }
};
