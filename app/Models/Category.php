<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model {

	/**
	 * Create a conversation slug.
	 *
	 * @param  string $title
	 *
	 * @return string
	 */
	public static function makeSlugFromTitle( $title ) {
		$slug = Str::slug( $title );

		$count = Category::whereRaw( "slug RLIKE '^{$slug}(-[0-9]+)?$'" )->count();

		return $count ? "{$slug}-{$count}" : $slug;
	}

	public function posts() {
		$this->belongsToMany( 'App\Models\Post', 'category_posts' )->orderBy( 'created_at', 'DESC' )->paginate( 5 );
	}

	public function getRouteKeyName() {
		return 'slug';
	}
}
