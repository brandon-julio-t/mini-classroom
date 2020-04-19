<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoneAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('done_assignments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at');

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete()
                ->onUpdate('cascade');

            $table->foreignId('assignment_id')
                ->constrained()
                ->cascadeOnDelete()
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('done_assignments');
    }
}
