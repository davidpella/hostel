<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->enum('gender', ['female', 'male']);
            $table->enum('continuation', ['continuing', 'fresh']);
            $table->enum('locale', ['international', 'domestic']);
            $table->enum('registration_number_type', ['csee', 'college', 'other']);
            $table->string('registration_number')->nullable();
            $table->foreignId('course_id')->constrained();
            $table->boolean('is_disabled')->default(false);
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
        Schema::dropIfExists('students');
    }
}
