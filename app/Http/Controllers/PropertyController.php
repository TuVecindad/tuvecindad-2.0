<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\Property;
use App\User;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $property = Property::paginate(10)->onEachSide(5);

        $users = User::all();

        return view('dashboard.properties.index', compact('property', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    
        return view('dashboard.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //       
        $validatedData = ([
            'cad_ref_pro' => 'required|unique:property|max:255',
            'owner' => 'max:255',
            'tenant' => 'max:255',
            'house_id'=>'boolean',
            'parking_id'=>'boolean',
            'storage_id'=>'boolean'
        ]);
        $property = Property::create($this->validate($request, $validatedData));

        return redirect('/property')->with('success', 'propiedad creada');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function __construct()
    {
         $this->middleware('auth');
    }
}
