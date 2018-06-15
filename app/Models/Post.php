<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
	/**
	 * Create a conversation slug.
	 *
	 * @param  string $title
	 *
	 * @return string
	 */
	public static function makeSlugFromTitle( $title ) {
		$slug = Str::slug( $title );

		$count = Post::whereRaw( "slug RLIKE '^{$slug}(-[0-9]+)?$'" )->count();

		return $count ? "{$slug}-{$count}" : $slug;
	}

	/**
	 * @return mixed
	 */
	public function tags() {
		return $this->belongsToMany( 'App\Models\Tag', 'post_tags' )->withTimestamps();
	}

	/**
	 * @return mixed
	 */
	public function categories() {
		return $this->belongsToMany( 'App\Models\Category', 'category_posts' )->withTimestamps();
	}

	public function likes() {
		$this->hasMany( 'App\Models\Like' );
	}

	/**
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'slug';
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	/*public function getSlugAttribute( $value ) {

		return route( 'post', $value );
	}*/

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function getCreatedAtAttribute( $value ) {

		return Carbon::parse( $value )->diffForHumans();

	}
}
