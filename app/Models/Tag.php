<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model {


	/**
	 * Create a conversation slug.
	 *
	 * @param  string $title
	 *
	 * @return string
	 */
	public static function makeSlugFromTitle( $title ) {
		$slug = Str::slug( $title );

		$count = Tag::whereRaw( "slug RLIKE '^{$slug}(-[0-9]+)?$'" )->count();

		return $count ? "{$slug}-{$count}" : $slug;
	}

	public function getRouteKeyName() {
		return 'slug';
	}
}
