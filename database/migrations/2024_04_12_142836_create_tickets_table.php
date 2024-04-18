<?php

use App\Models\Client;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'created_by'); // Empresa_id
            $table->foreignIdFor(Client::class); // Empresa_id
            $table->dateTime('scheduling_date')->nullable();
            $table->string('client_name'); // Problema relatado
            $table->string('client_phone'); // Problema relatado
            $table->string('reported_issue'); // Problema relatado
            $table->enum('status', ['scheduled', 'open', 'in_progress', 'finished'])->default('open'); // Status
            $table->text('solution')->nullable(); // Solução
            $table->text('observation')->nullable(); // Observação
            $table->boolean('finished_at')->nullable(); // Finalizado (padrão: true)
            $table->foreignIdFor(User::class, 'finished_by')->nullable(); // Técnico (referência a User)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
