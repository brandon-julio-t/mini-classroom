<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDoneAssignmentsToSubmittedAssignments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('done_assignments', function (Blueprint $table) {
            $table->rename('submitted_assignments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submitted_assignments', function (Blueprint $table) {
            $table->rename('done_assignments');
        });
    }
}
