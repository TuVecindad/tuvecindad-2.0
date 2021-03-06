<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
        $users = User::all();
        $request->user()->authorizeRoles(['superadmin']);
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        User::find(Auth::id())->authorizeRoles(['superadmin']);
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);

        $user = User::create($validatedData);

        return redirect('/users')->with('success', 'User is successfully saved');
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
        $user = User::findOrFail($id);

        if (Auth::id() != $id) {
            User::find(Auth::id())->authorizeRoles(['superadmin']);
        }

        return view('dashboard.users.edit', compact('user'));
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
        $validatedData = $request->validate([
            'name' => ['max:255'],
            'surname1' => ['max:255'],
            'surname2' => ['max:255'],
            'phone1' => ['max:255'],
            'phone2' => ['max:255'],
            'nif' => ['max:255']
        ]);

        User::whereId($id)->update($validatedData);

        return redirect('/users/' . $id . '/edit')->with('success', 'Has introducido los datos correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'El usuario ha sido borrado con éxito');
    }

    public function premium($id) {

        $user = User::findOrFail($id);

        if (Auth::id() != $id) {
            User::find(Auth::id())->authorizeRoles(['superadmin']);
        }


        return view('dashboard.users.premium', compact('user'));
    }

    public function updatePremium(Request $request, $id){

        $request['payment'] = Hash::make($request['payment']);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'surname1' => 'required|max:255',
            'surname2' => 'max:255',
            'phone1' => 'required|max:255',
            'phone2' => 'max:255',
            'nif' => 'required|max:255',
            'payment' => 'required|max:255',
            'subscription_type' => 'required|max:255'
        ]);


        $user = User::whereId($id);

        // $user->attach($request['subscription_type']);

        $user->update($validatedData);

        return redirect('/users/' . $id . '/premium')->with('success', 'La subscripción ' . $request['subscription_type'] . ' ha sido activada' .
        ' correctamente');
    }
}
