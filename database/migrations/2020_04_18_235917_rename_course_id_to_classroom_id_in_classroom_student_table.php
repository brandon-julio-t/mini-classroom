<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCourseIdToClassroomIdInClassroomStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classroom_student', function (Blueprint $table) {
            $table->renameColumn('course_id', 'classroom_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classroom_student', function (Blueprint $table) {
            $table->renameColumn('classroom_id', 'course_id');
        });
    }
}
