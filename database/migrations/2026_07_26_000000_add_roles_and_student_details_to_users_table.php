<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('student')->after('email');
            $table->string('mobile', 25)->nullable()->after('role');
            $table->string('work_status')->nullable()->after('mobile');
            $table->foreignId('assigned_subadmin_id')->nullable()->after('work_status')
                ->constrained('users')->nullOnDelete();
            $table->unsignedTinyInteger('progress')->default(0)->after('assigned_subadmin_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('assigned_subadmin_id');
            $table->dropColumn(['role', 'mobile', 'work_status', 'progress']);
        });
    }
};
