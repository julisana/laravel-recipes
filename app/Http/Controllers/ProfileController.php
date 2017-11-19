<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Requests\Profile as ProfileRequest;

class ProfileController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $this->addContext( 'user', auth()->user() );

        return response()->view( 'profile.index', $this->context );
    }

    /**
     * @return Response
     */
    public function recipes()
    {
        /** @var User $user */
        $user = auth()->user();

        $this->addContext( 'user', $user )
            ->addContext( 'savedRecipes', $user->savedRecipes() )
            ->addContext( 'createdRecipes', $user->createdRecipes() );

        return response()->view( 'profile.recipes', $this->context );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        $this->addContext( 'user', auth()->user() );

        return view( 'profile.edit', $this->context );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     *
     * @return Response
     */
    public function update( ProfileRequest $request )
    {
        /** @var User $user */
        $user = auth()->user();
        $user->update( $request->all() );

        return redirect()->route( 'profile.edit' );
    }
}
