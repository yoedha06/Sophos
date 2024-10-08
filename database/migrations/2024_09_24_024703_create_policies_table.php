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
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('id_policies');
            $table->string('name');
            $table->string('type');
            $table->boolean('locked_by_managing_account');
            $table->integer('priority');
            $table->string('tenant_id');
            $table->boolean('enabled')->nullable();
            $table->json('settings');
            $table->timestamps();

            $table->foreign('type')->references('type_policy')->on('policy_settings')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id_tenant')->on('tenants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
