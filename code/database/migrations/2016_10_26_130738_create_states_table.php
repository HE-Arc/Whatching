<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description');
            $table->timestamps();
        });

        DB::table('states')->insert([
          'name' => 'Pending',
          'description' => 'The suggestion is waiting for your approval.'
        ]);

        DB::table('states')->insert([
          'name' => 'Accepted',
          'description' => 'The suggestion is accepted.'
        ]);

        DB::table('states')->insert([
          'name' => 'Refused',
          'description' => 'The suggestion is refused.'
        ]);

        DB::table('states')->insert([
          'name' => 'Viewed',
          'description' => 'The movie has been viewed.'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
