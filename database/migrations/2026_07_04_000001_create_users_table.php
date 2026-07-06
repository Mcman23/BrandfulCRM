<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->enum('role', ['SUPER_ADMIN', 'ADMIN', 'MENEGER', 'SATIS_EMKDAS'])->default('SATIS_EMKDAS');
            $table->uuid('company_id')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Foreign key to companies added later, once that table exists
            // (see 2026_07_04_000002_create_companies_table.php).
            $table->index('email');
            $table->index('company_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
