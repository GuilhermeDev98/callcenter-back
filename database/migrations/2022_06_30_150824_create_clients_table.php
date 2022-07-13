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
        Schema::create('clients', function (Blueprint $table) {
            $table->string('registration');//->unique();
            $table->longText('profile_photo')->nullable();
            $table->string('full_name', 250);
            $table->string('full_mother_name', 250);
            $table->string('full_father_name', 250);
            $table->string('cpf', 11);//->unique();
            $table->string('rg');//->unique();
            $table->string('address');
            $table->string('number_of_house');
            $table->string('district');
            $table->string('city');
            $table->string('state');
            $table->string('cep');
            $table->string('contact_email');
            $table->string('contact_phone_1');
            $table->string('contact_name_1');
            $table->string('contact_phone_2')->nullable();
            $table->string('contact_name_2')->nullable();
            $table->longText('auxiliary_information')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('clients');
    }
};
