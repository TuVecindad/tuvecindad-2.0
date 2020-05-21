<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommonArea;

class CommonAreaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //mofica el area común de una comunidad
        $common = CommonArea::findOrFail($id);

        return view('common.update', compact('common'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        $validatedData = $request->validate([
            'comunidad' => 'required|max:255',
            'piscina' => 'required|numeric',
            'gym' => 'required|numeric',
            'hall' => 'required|numeric',
            'azotea' => 'required|numeric',
            'jardin' => 'required|numeric',
        ]);
        CommonArea::whereId($id)->update($validatedData);

        return redirect('/commonarea')->with('success', 'Show is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
