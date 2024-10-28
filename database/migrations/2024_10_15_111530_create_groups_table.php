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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_group');
            $table->string('tenant_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type');
            $table->bigInteger('total_assigned')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')->references('id_tenant')->on('tenants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
