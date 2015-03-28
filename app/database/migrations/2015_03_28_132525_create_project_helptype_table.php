<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectHelptypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_helptype', function(Blueprint $table)
		{
            $table->integer('project_id')->unsigned();
            $table->integer('help_type_id')->unsigned();
            $table->primary(array('project_id', 'help_type_id'));
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('help_type_id')->references('id')->on('help_types')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_helptype');
	}

}
