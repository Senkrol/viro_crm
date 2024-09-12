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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
           
            $table->unsignedBigInteger('organization_region_id');
            $table->foreign('organization_region_id')->references('id')->on('organizations_regions');

            $table->unsignedBigInteger('organization_district_id');
            $table->foreign('organization_district_id')->references('id')->on('organizations_districts');
            
            $table->unsignedBigInteger('organization_founder_id');
            $table->foreign('organization_founder_id')->references('id')->on('organizations_founders');
           
            $table->unsignedBigInteger('organization_type_id');
            $table->foreign('organization_type_id')->references('id')->on('organizations_types');

            $table->string('code_OU');
            $table->string('full_name');
            $table->string('short_name');
            $table->boolean('village_city');
            $table->string('postal_address');
            $table->string('director_surname');
            $table->string('director_name');
            $table->string('director_patronymic');
            $table->string('inn');
            $table->string('org_phone');
            $table->string('org_email');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};