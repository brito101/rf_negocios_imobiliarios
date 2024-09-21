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
        Schema::table('users', function (Blueprint $table) {
            $table->string('document_person')->nullable();
            $table->string('creci')->nullable();
        });

        DB::statement('
        CREATE OR REPLACE VIEW `users_view` AS
        SELECT u.id, u.name, u.email, u.creci, mr.role_id, r.name as type
        FROM users as u
        LEFT JOIN model_has_roles as mr ON mr.model_id = u.id
        LEFT JOIN roles as r ON r.id = mr.role_id
        WHERE u.deleted_at IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['document_person', 'creci']);
        });

        DB::statement('
        CREATE OR REPLACE VIEW `users_view` AS
        SELECT u.id, u.name, u.email, mr.role_id, r.name as type
        FROM users as u
        LEFT JOIN model_has_roles as mr ON mr.model_id = u.id
        LEFT JOIN roles as r ON r.id = mr.role_id
        WHERE u.deleted_at IS NULL
        ');
    }
};
