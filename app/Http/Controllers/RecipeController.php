<?php

namespace App\Http\Controllers;

use Throwable;
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
        $this->addContext( 'recipes', recipe()->paginate( 30 ) );

        return view( 'recipes.index', $this->context );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view( 'recipes.create', $this->context );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RecipeRequest $request
     *
     * @return Response
     */
    public function store( RecipeRequest $request )
    {
        return recipe()::createNew( $request );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show( $slug, $id )
    {
        $this->addContext( 'slug', $slug )
            ->addContext( 'recipe', recipe()->with( [ 'ingredients', 'directions' ] )->findOrFail( $id ) );

        return view( 'recipes.show', $this->context );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit( $id )
    {
        $this->addContext( 'recipe', recipe()->with( 'ingredients', 'directions' )->findOrFail( $id ) );

        return view( 'recipes.edit', $this->context );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RecipeRequest $request
     * @param int           $id
     *
     * @return Response
     * @throws Throwable
     */
    public function update( RecipeRequest $request, $id )
    {
        $recipe = recipe()::find( $id );
        $recipe->updateItem( $request );

        return redirect( $recipe->getUrl() );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws Throwable
     */
    public function destroy( $id )
    {
        $recipe = recipe()::find( $id );
        $recipe->delete();

        return redirect( route( 'recipes.index' ) );
    }
}
