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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['member', 'operator', 'admin'])->default('member')->after('email');
            $table->string('no_identitas')->nullable()->after('role');
            $table->text('alamat')->nullable()->after('no_identitas');
            $table->string('no_telepon')->nullable()->after('alamat');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'no_identitas', 'alamat', 'no_telepon']);
            $table->dropSoftDeletes();
        });
    }
};
