<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanydata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companyData', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cin');
            $table->string('name');
            $table->string('status');
            $table->integer('age');
            $table->string('regno');
            $table->string('category');
            $table->string('subcategory');
            $table->string('class');
            $table->string('roccode');
            $table->string('noofmembers');
            $table->string('email');
            $table->string('regoffice');
            $table->string('islisted');
            $table->string('dateOfagm');
            $table->string('dateBalanceSheet');
            $table->string('state');
             $table->string('district');
            $table->string('city');
            $table->string('pin');
            $table->string('section');
            $table->string('division');
            $table->string('maingroup');
            $table->string('mainclass');
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
        Schema::dropIfExists('companyData');
    }
}
