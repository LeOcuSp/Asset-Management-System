<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\CodeCoverage\BranchAndPathCoverageNotSupportedException;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asset_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('asset_category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('asset_damage_id')->nullable()->constrained()->cascadeOnDelete(); // Add this line
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->date('date_of_purchase')->nullable();
            $table->string('description')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('asset_number')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->nullable();
            $table->date('date_of_warranty')->nullable();
            $table->foreignId('asset_donor_id')->nullable()->constrained('asset_donors'); // Make sure donors table exists
            $table->string('location')->nullable();
            $table->string('vendor')->nullable();
            $table->decimal('purchased_price', 8, 2)->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_items');
    }
};
