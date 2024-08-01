<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('departments')->insert([
            ['name' => 'Admin/HR'],
            ['name' => 'Board of Directors'],
            ['name' => 'Capacity Building'],
            ['name' => 'Finance'],
            ['name' => 'Grant'],
            ['name' => 'Information and Communication Technology'],
            ['name' => 'Monitoring and Evaluation'],
            ['name' => 'Program'],
            ['name' => 'Quality Improvement'],
            ['name' => 'Supply Chain'],
            ['name' => 'Executive Body'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
