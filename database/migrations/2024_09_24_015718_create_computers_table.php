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
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->string('id_computer')->unique();
            $table->string('type');
            $table->string('tenant_id');
            $table->string('hostname');
            $table->string('health_overall_status');
            $table->string('health_threats_status');
            $table->string('health_service_status');
            $table->json('health_service_details');
            $table->json('operating_system');
            $table->json('ipv4_addresses');
            $table->json('mac_addresses');
            $table->json('group')->nullable();
            $table->json('assosiated_person')->nullable();
            $table->boolean('tamper_protection_enabled');
            $table->json('assigned_products');
            $table->timestamp('last_seen_at');
            $table->json('encryption');
            $table->json('isolation');
            $table->timestamps();

            $table->foreign('tenant_id')->references('id_tenant')->on('tenants')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computers');
    }
};
