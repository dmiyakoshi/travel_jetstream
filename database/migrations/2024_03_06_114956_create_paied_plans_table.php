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
        Schema::create('paied_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')
            ->constrained()
            ->onUpdate()
            ->onDelete();
            $table->foreignId('user_id')
            ->constrained()
            ->onUpdate()
            ->onDelete();
            // ユニークにしたいが、もう一度同じプランを予約した場合は？
            $table->unique(['user_id', 'plan_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paied_plans');
    }
};
