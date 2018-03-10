<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
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

    public function recipe( $id )
    {

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
        $user->setAttribute( 'name', $request->get( 'name', '' ) );
        $user->setAttribute( 'email', $request->get( 'email', '' ) );

        if ( !empty( $request->get( 'password', '' ) ) ) {
            $user->setAttribute( 'password', bcrypt( $request->get( 'password' ) ) );
        }
        $user->save();

        return redirect()->route( 'profile.edit' );
    }
}
