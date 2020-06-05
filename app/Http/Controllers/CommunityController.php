<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\User;
use App\Role;

class CommunityController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $communities = Community::paginate(10)->onEachSide(5);

        $request->user()->authorizeRoles(['owner', 'admin', 'tenant']);

        return view('dashboard.communities.index', compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.communities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = ([
            'cad_ref_com' => 'required|unique:communities|max:255',
            'address' => 'required|max:255',
            'apart_num' => 'required|max:255'
        ]);

        $messages = [
            'cad_ref_com.required' => 'El campo "Referencia catastral" es necesario.',
            'cad_ref_com.unique' => 'La referencia catastral ya esta en uso.',
            'address.required' => 'El campo "Dirección" es necesario.',
            'apart_num.required' => 'El campo "Numero de apartamentos" es necesario.',
        ];

        $communities = Community::create($this->validate($request, $validatedData, $messages));

        $user = auth()->user();

        $communities->users()->attach($user->id);
        
        return redirect('/communities')->with('success', 'Comunidad creada');
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

        $community = Community::findOrFail($id);

        return view('dashboard.communities.edit', compact('community'));
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

        $communities = Community::all();

        $validatedData = $request->validate([
            'cad_ref_com' => 'required|unique:communities,cad_ref_com,' . $id .'|max:255',
            'address' => 'required|max:255',
            'apart_num' => 'required|max:255'
        ]);

        $messages = [
            'cad_ref_com.required' => 'El campo "Referencia catastral" es necesario.',
            'cad_ref_com.unique' => 'La referencia catastral ya esta en uso.',
            'address.required' => 'El campo "Dirección" es necesario.',
            'apart_num.required' => 'El campo "Numero de apartamentos" es necesario.',
        ];

        Community::whereId($id)->update($validatedData);

        return redirect('/communities')->with('success', 'Comunidad editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $community = Community::findOrFail($id);
        $community->delete();

        return redirect('/communities')->with('success', 'Comunidad eliminada');
    }
}
