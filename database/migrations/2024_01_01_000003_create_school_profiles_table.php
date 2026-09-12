<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('MI Darul Falah');
            $table->string('npsn')->default('69881899');
            $table->string('nsm')->default('111235150224');
            $table->string('status')->default('Swasta');
            $table->string('accreditation')->default('B');
            $table->year('established_year')->default(2007);
            $table->text('address');
            $table->string('whatsapp');
            $table->string('email');
            $table->string('headmaster');
            $table->text('vision');
            $table->json('extracurriculars')->nullable();
            $table->json('facilities')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
