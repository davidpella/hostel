<?php

use App\Models\AcademicYear;
use App\Models\RoomType;
use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->double("amount");
            $table->foreignIdFor(Student::class)->constrained();
            $table->foreignIdFor(RoomType::class)->constrained();
            $table->foreignIdFor(AcademicYear::class)->constrained();
            $table->enum('status', ['pending', 'on progress', 'rejected', 'completed'])->default('pending');
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
        Schema::dropIfExists('applications');
    }
}
