<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'routines', function ( Blueprint $table ) {

            $table->bigIncrements('id');

            $table->string( 'title' );
            $table->string( 'description' );

            $table->text( 'notes' ); // putting this here out of compulsion.. not really sure what this is going to used for right now..

            $table->unsignedBigInteger( 'user_id' );
                $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );

            $table->string( 'repetition' )->nullable();
            $table->integer( 'duration' )->nullable();

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
        Schema::dropIfExists('routines');
    }
}
