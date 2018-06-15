<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller {
	public function __construct() {

		$this->middleware( 'auth:admin' );

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$posts = Post::all();

		return view( 'admin.post.show', compact( 'posts' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$tags       = Tag::all();
		$categories = Category::all();

		return view( 'admin.post.create', compact( 'tags', 'categories' ) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$this->validate( $request, [
			'title' => 'required',
			'body'  => 'required',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		] );

		if ( $request->hasFile( 'image' ) ) {
			$imageName = $request->image->store( 'public/posts' );
		} else {
			return 'No';
		}

		$post            = new Post();
		$post->image     = $imageName;
		$post->title     = $request->title;
		$post->sub_title = $request->sub_title;
		$post->slug      = Post::makeSlugFromTitle( $request->title );
		$post->body      = $request->body;
		$post->status    = $request->status;
		$post->posted_by = 0;

		$post->save();

		$post->tags()->sync( $request->tags );
		$post->categories()->sync( $request->categories );

		return redirect( route( 'post.index' ) );

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		$post       = post::with( 'tags', 'categories' )->where( 'id', $id )->first();
		$tags       = tag::all();
		$categories = category::all();

		return view( 'admin.post.view', compact( 'post' ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		$post       = post::with( 'tags', 'categories' )->where( 'id', $id )->first();
		$tags       = tag::all();
		$categories = category::all();

		return view( 'admin.post.edit', compact( 'post', 'tags', 'categories' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {

		$edit_rules = [ ];
		if ( $request->hasFile( 'image' ) ) {
			$edit_rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$this->validate( $request, [
			'title' => 'required',
			'body'  => 'required',
			$edit_rules
		] );

		$post = Post::find( $id );

		if ( $request->hasFile( 'image' ) ) {
			if ( ! empty( $post->image ) ) {
				Storage::Delete( $post->image );
			}
			$imageName = $request->image->store( 'public/posts' );
		}

		if ( ! empty( $imageName ) ) {
			$post->image = $imageName;
		}

		$post->title     = $request->title;
		$post->sub_title = $request->sub_title;

		$requestedSlug = str_slug( $request->title );

		if ( $post->slug != $requestedSlug ) {
			$post->slug = Post::makeSlugFromTitle( $request->title );
		}

		$post->body      = $request->body;
		$post->status    = $request->status;
		$post->posted_by = 0;

		$post->save();

		$post->tags()->sync( $request->tags );
		$post->categories()->sync( $request->categories );

		return redirect( route( 'post.index' ) );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}
}
