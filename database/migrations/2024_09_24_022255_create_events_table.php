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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('id_event');
            $table->string('source');
            $table->string('endpoint_type');
            $table->string('severity');
            $table->timestamp('event_create_at');
            $table->string('source_info');
            $table->string('customer_id');
            $table->string('computer_id');
            $table->string('type');
            $table->string('user_id');
            $table->timestamp('when');
            $table->json('core_remedy_items')->nullable();
            $table->text('name');
            $table->string('location');
            $table->string('group');
            $table->timestamps();

            $table->foreign('computer_id')->references('id_computer')->on('computers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
