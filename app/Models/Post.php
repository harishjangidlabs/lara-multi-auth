<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
	public function getCreatedAtAttribute( $value ) {

		return Carbon::parse( $value )->diffForHumans();

	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public function getSlugAttribute( $value ) {

		return route( 'post', $value );
	}
}
