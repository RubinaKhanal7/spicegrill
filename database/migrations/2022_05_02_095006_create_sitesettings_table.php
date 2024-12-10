<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitesettings', function (Blueprint $table) {
            $table->id();
            $table->string('govn_name')->nullable();
            $table->string('ministry_name')->nullable();
            $table->string('department_name')->nullable();
            $table->string('office_name');
            $table->string('office_address');
            $table->string('office_contact');
            $table->string('office_mail');
            $table->string('main_logo');
            $table->string('side_logo')->nullable();
            $table->string('face_link',1000)->nullable();
            $table->string('insta_link',1000)->nullable();
            $table->string('linked_link', 1000)->nullable();
            $table->string('social_link', 1000)->nullable();
            $table->longText('google_maps', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sitesettings');
    }
};
