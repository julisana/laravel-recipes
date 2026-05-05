<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Response;
use App\Http\Requests\SpiceRackItem as SpiceRackRequest;

class SpiceRackController extends Controller
{
    /**
     * Get latest recipes from each category.
     *
     * @return Response
     */
    public function index()
    {
        $this->addContext( 'spices', recipe()->paginate( 30 ) );

        return view( 'spice-rack.index', $this->context );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view( 'spice-rack.create', $this->context );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SpiceRackRequest $request
     *
     * @return Response
     */
    public function store( SpiceRackRequest $request )
    {
        return spiceRackItem()::createNew( $request );
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @param int $id
     *
     * @return Response
     */
    public function show( $slug, $id )
    {
        $this->addContext( 'slug', $slug )
            ->addContext( 'spiceRackItem', spiceRackItem()->findOrFail( $id ) );

        return view( 'spice-rack.show', $this->context );
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
        $this->addContext( 'spiceRackItem', recipe()->findOrFail( $id ) );

        return view( 'spice-rack.edit', $this->context );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SpiceRackRequest $request
     * @param int           $id
     *
     * @return Response
     * @throws Throwable
     */
    public function update( SpiceRackRequest $request, $id )
    {
        $spiceRackItem = spiceRackItem()::find( $id );
        $spiceRackItem->updateItem( $request );

        return redirect( route( 'spice-rack.index' ) );
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
        $spiceRackItem = spiceRackItem()::find( $id );
        $spiceRackItem->delete();

        return redirect( route( 'spice-rack.index' ) );
    }
}
