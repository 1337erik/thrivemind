<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'tasks', function ( Blueprint $table ) {

            $table->bigIncrements( 'id' );

            $table->string( 'title' );
            $table->string( 'description' )->nullable();
            $table->text( 'notes' )->nullable();

            $table->boolean( 'completed' )->default( false );

            $table->unsignedBigInteger( 'user_id' );
                $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );

            $table->string( 'repetition' )->nullable();
            $table->integer( 'duration' )->nullable();

            $table->dateTime( 'due_date' );

            $table->softDeletes();
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
        Schema::dropIfExists('tasks');
    }
}
