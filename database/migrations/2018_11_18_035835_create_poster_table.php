<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePosterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('poster', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('judul');
			$table->string('thumbnail');
			$table->timestamp('publish')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('isi', 65535)->nullable();
			$table->timestamps();
			$table->softDeletes()->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('poster');
	}

}
