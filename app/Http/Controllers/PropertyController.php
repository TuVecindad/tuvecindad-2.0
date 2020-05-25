<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class PropertyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
//se configura un paginador
        $properties = Property::latest()->paginate(5);

        return view('property.index', compact('properties'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
//crea una nueva propiedad
        return view('property.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//almacena la propiedad
        $request->validate([
            'cad_ref_pro' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('property.index')
                        ->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Property $id) {
//muestra las propiedades
        return view('property.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $id) {
//modifica la propipedad
        return view('property.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $id) {
//actualiza la propiedad
        $request->validate([
            'cad_ref_pro' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('property.index')
                        ->with('success', 'Property updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $id) {
        //elimina una propiedad
        $product->delete();

        return redirect()->route('property.index')
                        ->with('success', 'Property deleted successfully');
    }

}
