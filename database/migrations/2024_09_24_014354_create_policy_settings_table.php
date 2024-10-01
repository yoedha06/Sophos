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
        Schema::create('policy_settings', function (Blueprint $table) {
            $table->id();
            $table->string('type_policy')->unique();
            $table->string('name');
            $table->mediumText('description');
            $table->string('type_setting');
            $table->boolean('use_valid_only_in_base_policy');
            $table->boolean('use_valid_only_in_additional_policies');
            $table->boolean('readonly_in_base_policy');
            $table->boolean('readonly_in_additional_policies');
            $table->json('default_value')->nullable();
            $table->json('allowed_value')->nullable();
            $table->string('default_format')->nullable();
            $table->json('limit')->nullable();
            $table->json('default_unit')->nullable();
            $table->json('allowed_unit')->nullable();
            $table->json('allowed_format')->nullable();
            $table->json('examples')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_settings');
    }
};
