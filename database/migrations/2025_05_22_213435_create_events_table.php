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
            // $table->id();
            $table->ulid("id")->unique();
            $table->string("event_name", length: 100);
            $table->timestamp("start_date");
            $table->timestamp("end_date");
            $table->unsignedBigInteger("created_by");
            $table->text("description");
            $table->text("location");
            $table->timestamps();
            $table->tinyInteger("is_active")->default(true);

            $table->foreign("created_by")->references("id")->on("users");
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
