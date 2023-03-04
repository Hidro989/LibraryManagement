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
        Schema::create('admins', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('password');
        });

        Schema::create('staffs', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('password');
            $table->string('name');
            $table->integer('gender')->default(0);
            $table->string('phone');
            $table->string('address');
        });

        Schema::create('loancards', function (Blueprint $table) {
            $table->id();
            $table->integer('idBook');
            $table->integer('idStaff');
            $table->integer('cmndReader');
            $table->boolean('status');
            $table->date('dateStart');
            $table->date('dateEnd');
        });

        Schema::create('books', function (Blueprint $table) {
            $table->string('isbn')->primary();
            $table->string('name');
            $table->integer('idStaff');
            $table->integer('idTypeBook');
            $table->string('author');
            $table->string('publisher');
            $table->integer('publishingYear');
            $table->boolean('status');
        });

        Schema::create('typebook', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('readers', function (Blueprint $table) {
            $table->string('cmnd')->primary();
            $table->string('name');
            $table->string('address');
        });

        Schema::create('offences', function (Blueprint $table) {
            $table->id();
            $table->integer('idLoanCard');
            $table->double('money');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
        Schema::dropIfExists('books');
        Schema::dropIfExists('staffs');
        Schema::dropIfExists('loancards');
        Schema::dropIfExists('readers');
        Schema::dropIfExists('offences');
        Schema::dropIfExists('typebook');



    }
};
