<?php

namespace App\Http\Controllers;

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
     */
    public function update( RecipeRequest $request, $id )
    {
        dd( $request->only( [ 'delete_ingredient', 'delete_direction' ] ) );
//        $recipe = recipe()->with( 'ingredients', 'directions' )->find( $id );
//
//        try {
//            $details = $request->except( '_token', 'ingredients', 'directions' );
//            foreach ( $details as $key => $value ) {
//                $recipe->{ $key } = $value;
//            }
//            $recipe->save();
//
//            $ingredients = $recipe->ingredients->keyBy( 'id' );
//            foreach ( $request->get( 'ingredients', [] ) as $key => $row ) {
//                //Set the order number value. Items should already be in the correct order, just need to add the value
//                $row[ 'order_number' ] = $key + 1;
////                $recipe->ingredients()->updateOrCreate( array_keys( $row ), $row );
//            }
//        }
//        catch ( Throwable $exception ) {
//            return redirect()->back()->withInput();
//        }
//
//        return redirect( $recipe->getUrl() );
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
