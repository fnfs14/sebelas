<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('judul');
			$table->string('url');
			$table->string('parent', 36)->nullable();
			$table->enum('menu', array('admin','client'));
			$table->timestamps();
			$table->softDeletes()->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu');
	}

}
