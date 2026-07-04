<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->uuid('client_id');
            $table->string('source');
            $table->enum('status', ['YENI_MURACIET', 'ELAQE_SAXLANILDI', 'GORUS_TEYIN_EDILDI', 'TEKLIF_GONDERILDI', 'DANISIQ_GEDIR', 'QAZANILDI', 'ITIRILDI'])->default('YENI_MURACIET');
            $table->uuid('service_id')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->uuid('assigned_user')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
            $table->foreign('assigned_user')->references('id')->on('users')->onDelete('set null');
            $table->index('company_id');
            $table->index('client_id');
            $table->index('status');
            $table->index('assigned_user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

