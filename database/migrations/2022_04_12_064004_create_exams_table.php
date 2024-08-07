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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            // $table->integer('year');
            // $table->string('code',60);
            // $table->dateTime('date');
            // $table->tinyInteger('total_mark');
            // $table->tinyInteger('pass_mark');
            // $table->tinyInteger('d_hour')->default(0);
            // $table->tinyInteger('d_minute')->default(0);
            // $table->string('mode',80);
            // $table->string('trade',80)->nullable();
            // $table->enum('status',['Pending', 'Created', 'Started', 'Completed']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
};
