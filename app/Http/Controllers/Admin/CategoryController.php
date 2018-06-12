<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{


	public function __construct() {
		$this->middleware( 'auth:admin' );
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $categories = Category::all();

	    return view( 'admin.category.show', compact( 'categories' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view( 'admin.category.create' );
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

	    $category = new Category();

	    $category->name   = $request->name;
	    $category->slug   = Category::makeSlugFromTitle( $request->name );
	    $category->status = $request->status;

	    $category->save();

	    return redirect( route( 'category.index' ) );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $category = Category::where( 'id', $id )->first();

	    return view( 'admin.category.edit', compact( 'category' ) );
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
		    'name' => 'required',
	    ] );

	    $category = Category::find( $id );

	    $requestedSlug = str_slug( $request->name );

	    if ( $category->slug != $requestedSlug ) {
		    $category->slug = Category::makeSlugFromTitle( $request->name );
	    }

	    $category->name = $request->name;

	    //dd($category);

	    $category->save();

	    return redirect( route( 'category.index' ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    category::where( 'id', $id )->delete();

	    return redirect()->back();
    }
}
