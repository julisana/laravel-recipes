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
        $context = [
            'user' => auth()->user(),
        ];

        return response()->view( 'profile.index', $context );
    }

    /**
     * @return Response
     */
    public function recipes()
    {
        /** @var User $user */
        $user = auth()->user();

        $context = [
            'user' => $user,
            'savedRecipes' => $user->savedRecipes(),
            'createdRecipes' => $user->createdRecipes(),
        ];

        return response()->view( 'profile.recipes', $context );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        $context = [
            'user' => auth()->user(),
        ];

        return view( 'profile.edit', $context );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileRequest $request
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
