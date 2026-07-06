<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->uuid('deal_id')->nullable();
            $table->string('title');
            $table->enum('category', ['NEQLIYYAT', 'MATERIAL', 'EMEK_HAQQI', 'MARKETINQ', 'ICARE', 'DIGER'])->default('DIGER');
            $table->decimal('amount', 10, 2);
            $table->date('expense_date');
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('set null');
            $table->index('company_id');
            $table->index('deal_id');
            $table->index('expense_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
