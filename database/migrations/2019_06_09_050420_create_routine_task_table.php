<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutineTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'routine_task', function ( Blueprint $table ) {

            $table->bigIncrements( 'id' );

            $table->unsignedBigInteger( 'task_id' );
                $table->foreign( 'task_id' )->references( 'id' )->on( 'tasks' )->onDelete( 'cascade' );

            $table->unsignedBigInteger( 'routine_id' );
                $table->foreign( 'routine_id' )->references( 'id' )->on( 'routines' )->onDelete( 'cascade' );

            $table->unique([ 'task_id', 'routine_id' ]);
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
        Schema::dropIfExists( 'routine_tasks' );
    }
}
