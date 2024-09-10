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
        Schema::create('organizations_districts', function (Blueprint $table) {
            $table->id();

            $table->string('district_title');
            $table->unsignedBigInteger('organization_region_id');
            $table->foreign('organization_region_id')->references('id')->on('organizations_regions');
      
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations_districts');
    }
};
