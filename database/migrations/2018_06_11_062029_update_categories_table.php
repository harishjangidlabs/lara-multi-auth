<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategoriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table( 'categories', function ( Blueprint $table ) {
			$table->string( 'name' )->after( 'id' );
			$table->string( 'slug' )->after( 'name' );
			$table->tinyInteger( 'status' )->after( 'slug' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table( 'categories', function ( Blueprint $table ) {
			$table->dropColumn( 'name' );
			$table->dropColumn( 'slug' );
			$table->dropColumn( 'status' );
		} );
	}
}
