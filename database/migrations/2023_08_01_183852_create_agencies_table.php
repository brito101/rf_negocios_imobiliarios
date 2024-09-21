<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('alias_name');
            $table->string('social_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('document_company')->nullable();
            $table->string('document_company_secondary')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("
        CREATE OR REPLACE VIEW `agencies_view` AS
        SELECT a.id, a.alias_name, a.email, a.phone, CONCAT(a.city, '-', a.state) as address
        FROM agencies as a
        WHERE a.deleted_at IS NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
        DB::statement('DROP VIEW agencies_view');
    }
};
