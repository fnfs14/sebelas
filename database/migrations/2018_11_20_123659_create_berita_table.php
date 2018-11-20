<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBeritaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('berita', function(Blueprint $table)
		{
			$table->string('id', 36)->primary();
			$table->string('judul');
			$table->string('thumbnail');
			$table->dateTime('publish')->nullable();
			$table->string('sinopsis')->nullable();
			$table->text('isi', 65535)->nullable();
			$table->string('tempat')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('berita');
	}

}
