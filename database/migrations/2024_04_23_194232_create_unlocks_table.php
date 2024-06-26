<?php

use App\Models\User;
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
        Schema::create('unlocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'created_by')->constrained();
            $table->foreignId('rep_id')->constrained()->cascadeOnDelete();
            $table->string('responsible');
            $table->boolean('emergency')->default(false);
            $table->string('observation')->nullable();
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unlocks');
    }
};
