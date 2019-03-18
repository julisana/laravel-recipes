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
        $this->addContext( 'recipes', recipe()->all() );

        return view( 'recipes.index', $this->context );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view( 'recipes.new', $this->context );
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
        /** @var Recipe $recipe */
        $recipe = Recipe::create( [
            'name' => $request->get( 'name', null ),
            'difficulty' => $request->get( 'difficulty', null ),
            'description' => $request->get( 'description', null ),
            'source' => $request->get( 'source', null ),
            'source_url' => $request->get( 'source_url', null ),
            'notes' => $request->get( 'notes', null ),
            'prep_time' => $request->get( 'prep_time', null ),
            'cook_time' => $request->get( 'cook_time', null ),
            'servings' => $request->get( 'servings', null ),
            'serving_size' => $request->get( 'serving_size', null )
        ] );

        foreach ( $request->get( 'ingredients', [] ) as $key => $row ) {
            //Set the order number value. Items should already be in the correct order, just need to add the value
            $row[ 'order_number' ] = $key + 1;
            $recipe->ingredients()->create( $row );
        }

        foreach ( $request->get( 'directions', [] ) as $key => $row ) {
            //Set the order number value. Items should already be in the correct order, just need to add the value
            $row[ 'order_number' ] = $key + 1;
            $recipe->directions()->create( $row );
        }

        return redirect( $recipe->getUrl() );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
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
     */
    public function update( RecipeRequest $request, $id )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy( $id )
    {
        //
    }
}
