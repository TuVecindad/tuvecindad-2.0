<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\User;

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
        if ($request->user()->hasRole('superadmin')) {
            $communities = Community::Paginate(10);
        } else {
            $communities = Community::simplePaginate(10);
        }

        $request->user()->authorizeRoles(['superadmin', 'owner', 'admin', 'tenant']);

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

        $messages = [
            'cad_ref_com.required' => 'El campo "Referencia catastral" es necesario.',
            'cad_ref_com.unique' => 'La referencia catastral ya esta en uso.',
            'address.required' => 'El campo "Dirección" es necesario.',
            'apart_num.required' => 'El campo "Numero de apartamentos" es necesario.',
        ];

        $validatedData =  $request->validate([
            'cad_ref_com' => 'required|unique:communities,cad_ref_com,' . $id . '|max:255',
            'address' => 'required|max:255',
            'apart_num' => 'required|max:255'
        ], $messages);

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

    public function adduser($id)
    {
        $community = Community::findOrFail($id);

        return view('dashboard.communities.adduser', compact('community'));
    }

    public function storeuser(Request $request)
    {

        $messages = [
            'community_id.required' => 'El campo "Comunidad" es necesario.',
            'community_id.unique' => 'El usuario ya existe en la comunidad.',
            'email.unique' => 'El mail ya esta en uso.',
            'email.required' => 'El campo "Mail de usuario" es necesario.',
            'role_id.required' => 'El campo "Rol" es necesario.',
        ];

        $email = User::select('id')->where('email', $request['email'])->first();

        if ($email === null) {
            return redirect()->back()->with('error', 'El mail no existe');
        }
        else {
            $validatedData =  $request->validate([
                'community_id' => 'required|unique:community_user,community_id,NULL,id,user_id,' . $email->id . '|max:255',
                'email' => 'required|unique:community_user,user_id,NULL,id,community_id,' . $request['community_id'] . '|max:255',
                'role_id' => 'required|max:255'
            ], $messages);

            $email = $email->id;
            $users = User::find($email);
            $users->communities()->attach($request['community_id'], ['role_id' => $request['role_id']]);
            return redirect()->back()->with('success', 'El usuario ' . $request['email'] . ' ha sido agregado.');
        }
    }
}
