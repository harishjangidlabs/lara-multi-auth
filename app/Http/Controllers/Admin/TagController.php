<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $tags = Tag::all();

	    return view( 'admin.tag.show', compact( 'tags' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view( 'admin.tag.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $this->validate( $request, [
		    'name' => 'required'
	    ] );

	    $tag       = new Tag();
	    $tag->name = $request->name;
	    $tag->slug = Tag::makeSlugFromTitle( $request->name );
	    $tag->save();

	    return redirect( route( 'tag.index' ) );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    $tag = Tag::find( $id );

	    return view( 'admin.tag.view', compact( 'tag' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $tag = Tag::find( $id );

	    return view( 'admin.tag.edit', compact( 'tag' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    $this->validate( $request, [
		    'name' => 'required'
	    ] );

	    $tag           = Tag::find( $id );
	    $requestedSlug = str_slug( $request->name );

	    if ( $tag->slug != $requestedSlug ) {
		    $tag->slug = Tag::makeSlugFromTitle( $request->name );
	    }

	    $tag->name = $request->name;

	    $tag->save();

	    return redirect( route( 'tag.index' ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    Tag::where( 'id', $id )->delete();

	    return redirect()->back();
    }
}
