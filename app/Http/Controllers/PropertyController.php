<?php

namespace App\Http\Controllers;

use App\Community;
use App\ProHouse;
use App\ProParking;
use App\Property;
use App\ProStorage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->user()->hasRole('superadmin')) {
            $properties = Property::paginate(5);
        } else {
            $properties = Property::simplePaginate(5);
        }

        $request->user()->authorizeRoles(['superadmin', 'owner', 'admin', 'tenant']);
        return view('dashboard.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $community = Community::findOrFail($id);
        return view('dashboard.properties.create', compact('community'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'cad_ref_com.required' => 'El campo "Referencia catastral" es necesario.',
            'cad_ref_com.unique' => 'La referencia catastral ya esta en uso.',
            'address.required' => 'El campo "Dirección" es necesario.',
            'apart_num.required' => 'El campo "Numero de apartamentos" es necesario.',
        ];

        $validatedProperty = ([
            'cad_ref_pro' => 'required|unique:property,cad_ref_pro|max:255',
            'com_id' => 'max:255',
            'owner' => 'max:255',
            'tenant' => 'max:255',
            'house_id' => 'nullable|max:255',
            'parking_id' => 'nullable|max:255',
            'storage_id' => 'nullable|max:255'
        ]);

        switch ($request->get('type_form')) {
            case 'house':

                $validatedHouse = ([
                    'floor' => 'required|max:255',
                    'door' => 'required|max:255',
                    'sqm' => 'required|max:255',
                    'room' => 'required|max:255',
                    'bathroom' => 'required|max:255',
                    'occupants' => 'required|max:255',
                    'type' => 'max:255'
                ]);

                $prohouse = ProHouse::create($this->validate($request, $validatedHouse, $messages));

                $request->merge(['house_id' => $prohouse->id]);

                break;
            case 'parking':

                $validatedParking = ([
                    'num_p' => 'required|max:255',
                    'sqm_p' => 'required|max:255'
                ]);

                $proparking = ProParking::create($this->validate($request, $validatedParking, $messages));

                $request->merge(['parking_id' => $proparking->id]);

                break;
            case 'storage':

                $validatedStorage = ([
                    'num_s' => 'required|max:255',
                    'sqm_s' => 'required|max:255'
                ]);

                $prostorage = ProStorage::create($this->validate($request, $validatedStorage, $messages));

                $request->merge(['storage_id' => $prostorage->id]);

                break;
            default:
                break;
        }

        $owner = User::select('id')->where('email', $request['owner'])->first();
        if ($owner != null) {
            $owner = $owner->id;
        } else {
            $owner = null;
        }
        $request->merge(['owner' => $owner]);

        $tenant = User::select('id')->where('email', $request['tenant'])->first();
        if ($tenant != null) {
            $tenant = $tenant->id;
        } else {
            $tenant = null;
        }
        $request->merge(['tenant' => $tenant]);

        $property = Property::create($this->validate($request, $validatedProperty, $messages));
        $request->merge(['property_id' => $property->id]);

        if ($owner != null) {
            $request->merge(['role_id' => 3]);
            $validatedData =  $request->validate([
                'property_id' => 'required|unique:property_user,property_id,NULL,id,user_id,' . $owner . '|max:255',
                'owner' => 'required|unique:property_user,user_id,NULL,id,property_id,' . $request['property_id'] . '|max:255',
                'role_id' => 'required|max:255'
            ], $messages);

            $owner = User::find($owner);
            if ($owner->id === Auth::user()->id) {
                $owner->properties()->attach($request['property_id'], ['role_id' => 2]);
            } else {
                $owner->properties()->attach($request['property_id'], ['role_id' => $request['role_id']]);
            }
        } else {
            // EL mail no existe
        }

        if ($tenant != null) {
            $request->merge(['role_id' => 4]);
            $validatedData =  $request->validate([
                'property_id' => 'required|unique:property_user,property_id,NULL,id,user_id,' . $tenant . '|max:255',
                'tenant' => 'required|unique:property_user,user_id,NULL,id,property_id,' . $request['property_id'] . '|max:255',
                'role_id' => 'required|max:255'
            ], $messages);

            $tenant = User::find($tenant);
            if ($tenant->id == Auth::user()->id) {
                $tenant->properties()->attach($request['property_id'], ['role_id' => 2]);
            } else {
                $tenant->properties()->attach($request['property_id'], ['role_id' => $request['role_id']]);
            }
        } else {
        }

        $user = auth()->user();

        $property->users()->attach($user->id, ['role_id' => 2]);

        return redirect('/properties')->with('success', 'Propiedad creada.');
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
        $property = Property::findOrFail($id);
        $id = auth()->user()->id;

        if ($property->users()->where('user_id', $id)->pluck('role_id')->first() === 4) {
            User::find(Auth::id())->authorizeRoles(['superadmin']);
        }
        return view('dashboard.properties.edit', compact('property'));
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

        $this_property = Property::where('id', $id)->first();
        $request->merge(['cad_ref_pro' => $this_property->cad_ref_pro]);
        $request->merge(['property_id' => $this_property->id]);

        $owner = User::select('id')->where('email', $request['owner'])->first();
        if ($owner != null) {
            $owner = $owner->id;
        } else {
            $owner = null;
        }
        $request->merge(['owner' => $owner]);

        $tenant = User::select('id')->where('email', $request['tenant'])->first();
        if ($tenant != null) {
            $tenant = $tenant->id;
        } else {
            $tenant = null;
        }
        $request->merge(['tenant' => $tenant]);


        $messages = [
            // 'cad_ref_com.required' => 'El campo "Referencia catastral" es necesario.',
            // 'cad_ref_com.unique' => 'La referencia catastral ya esta en uso.',
            // 'address.required' => 'El campo "Dirección" es necesario.',
            // 'apart_num.required' => 'El campo "Numero de apartamentos" es necesario.',
        ];

        if ($owner != null) {
            $request->merge(['role_id' => 3]);
            
            $validatedData =  $request->validate([
                'property_id' => 'required|max:255|unique:property_user,property_id,NULL,id,property_id,' .  $request['property_id'],
                'owner' => 'required|max:255|unique:property_user,user_id,NULL,id,user_id,' .$owner,
                'role_id' => 'required|max:255',
            ], $messages);
            
            $owner = User::find($owner);
            if ($owner->id == Auth::user()->id) {
                $owner->properties()->attach($request['property_id'], ['role_id' => 2]);
            } else {
                $owner->properties()->attach($request['property_id'], ['role_id' => $request['role_id']]);
            }
        } else {
            // EL mail no existe
        }

        if ($tenant != null) {
            $request->merge(['role_id' => 4]);
            $validatedData =  $request->validate([
                'property_id' => 'required|max:255|unique:property_user,property_id,NULL,id,user_id,' . $tenant,
                'tenant' => 'required|max:255|unique:property_user,user_id,NULL,user_id,id,property_id,' . $request['property_id'],
                'role_id' => 'required|max:255'
            ], $messages);

            $tenant = User::find($tenant);
            if ($tenant->id == Auth::user()->id) {
                $tenant->properties()->attach($request['property_id'], ['role_id' => 2]);
            } else {
                $tenant->properties()->attach($request['property_id'], ['role_id' => $request['role_id']]);
            }
        } else {
            // EL mail no existe
        }

        $validatedProperty = $request->validate([
            'cad_ref_pro' => 'required|unique:property,cad_ref_pro,' . $this_property->id . '|max:255',
            'com_id' => 'max:255',
            'owner' => 'max:255',
            'tenant' => 'max:255',
            'house_id' => 'nullable|max:255',
            'parking_id' => 'nullable|max:255',
            'storage_id' => 'nullable|max:255'
        ], $messages);

        if ($this_property->house_id != null) {
            $validatedHouse = $request->validate([
                'floor' => 'required|max:255',
                'door' => 'required|max:255',
                'sqm' => 'required|max:255',
                'room' => 'required|max:255',
                'bathroom' => 'required|max:255',
                'occupants' => 'required|max:255',
                'type' => 'max:255'
            ], $messages);

            ProStorage::where('id', $this_property->house_id)->update($validatedHouse);
            $request->merge(['parking_id' => $this_property->house_id]);
        } elseif ($this_property->parking_id != null) {
            $validatedParking = $request->validate([
                'num_p' => 'required|max:255',
                'sqm_p' => 'required|max:255'
            ], $messages);


            ProParking::where('id', $this_property->parking_id)->update($validatedParking);
            $request->merge(['parking_id' => $this_property->parking_id]);
        } elseif ($this_property->storage_id != null) {
            $validatedStorage = $request->validate([
                'num_s' => 'required|max:255',
                'sqm_s' => 'required|max:255'
            ], $messages);

            ProStorage::where('id', $this_property->storage_id)->update($validatedStorage);
            $request->merge(['parking_id' => $this_property->storage_id]);
        }

        Property::where('id', $id)->update($validatedProperty);
        return redirect('/properties')->with('success', 'Propiedad actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return redirect('/properties')->with('success', 'Propiedad eliminada');
    }
}
