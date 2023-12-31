<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Auth;
use File;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view('subscriber.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        //Asignamos al user el usuario autenticado
        $user = Auth::user();
        //verificamos la existencia de una imagen actualizada para asignar la nueva o mantener la ya existente
        if($request->hasFile('photo')){
            File::delete(public_path('storage/' . $profile->photo));

            $photo = $request['photo']->store('profiles');
        } else {
            $photo = $user->profile->photo;
        }

        //asignamos los nuevos datos
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->profile->photo = $photo;
        //los guardamos y actualizamos en la database
        $user->save();
        $user->profile->save();

        return redirect()->route('profiles.edit', $user->profile->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
