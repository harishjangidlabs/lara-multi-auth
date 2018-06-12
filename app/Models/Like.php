<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

	public function post() {
		$this->belongsTo( 'App\Models\Post', 'like' );
	}
}
