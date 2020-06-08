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
                    'door' => 'unique:pro_house,door|required|max:255',
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
            if ($owner === Auth::user()->id) {
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
            if ($tenant == Auth::user()->id) {
                $tenant->properties()->attach($request['property_id'], ['role_id' => 2]);
            } else {
                $tenant->properties()->attach($request['property_id'], ['role_id' => $request['role_id']]);
            }
        } else {
        }

        return redirect('/communities')->with('success', 'Propiedad creada.');
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
}
