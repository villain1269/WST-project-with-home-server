<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * TSA3 users table: username unique, full_name, email — matching
     * TSA1's schema.
     *
     * NOTE: delete the Laravel skeleton's default
     * 0001_01_01_000000_create_users_table.php migration (and the
     * password_reset_tokens / sessions migrations, which depend on its
     * columns) before migrating, or the users table will be created twice.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
