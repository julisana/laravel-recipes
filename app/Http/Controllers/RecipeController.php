<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Response;
use App\Http\Requests\Recipe as RecipeRequest;

class RecipeController extends Controller
{
    /**
     * Get latest recipes from each category.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RecipeRequest $request
     * @return Response
     */
    public function store( RecipeRequest $request )
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show( $slug, $id )
    {
        $this->addContext( 'recipe', Recipe::findOrFail( $id )->with( 'ingredients', 'directions' )->first() );

        return view( 'recipes.show', $this->context );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit( $id )
    {
        $this->addContext( 'recipe', Recipe::findOrFail( $id )->with( 'ingredients', 'directions' )->first() );

        return view( 'recipes.edit', $this->context );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RecipeRequest $request
     * @param int $id
     * @return Response
     */
    public function update( RecipeRequest $request, $id )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy( $id )
    {
        //
    }
}
