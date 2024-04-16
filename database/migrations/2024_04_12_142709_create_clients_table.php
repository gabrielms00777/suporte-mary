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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'created_by')->nullable(); // User
            $table->string('business_name')->nullable(); // Razão Social
            $table->string('contact_person')->nullable(); // Contato
            $table->string('address')->nullable(); // Endereço
            $table->string('postal_code')->nullable(); // CEP
            $table->string('number')->nullable(); // Número
            $table->string('city')->nullable(); // Cidade
            $table->string('complement')->nullable(); // Complemento
            $table->string('cpf_cnpj')->nullable(); // CNPJ/CPF
            $table->string('phone1')->nullable(); // Telefone 1
            $table->string('phone2')->nullable(); // Telefone 2
            $table->boolean('contract')->default(true);
            $table->string('system')->nullable();
            $table->enum('status', ['active', 'inactive', 'blocked'])->nullable(); // Status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
