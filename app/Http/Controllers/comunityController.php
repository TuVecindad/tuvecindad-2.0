<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Community;
use Response;



class comunityController extends Controller {

public function __construct()
{
$this->middleware('auth.basic', ['only' => ['store', 'update', 'destroy']]);
}
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index() {
//devolverá todas la comunidades, se crea un filtro de registros
//y la respuesta http
return response()->json(['datos' => Community::all()], 200);
//                json(['status' => 'ok', 'data' => Community::all()], 200);
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create() {
//devolverá una vista del formulario para crear la comunidad en la base de datos
return view("includes.comunidades.create");
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request) {
//comprobamos si se reciben todos los campos
if(!$request->input('cad_ref_com')||!$request->input('address')
||!$request->input('apart_num')){
// Se devuelve un array errors con los errores encontrados y 
// cabecera HTTP 422 Unprocessable Entity – [Entidad improcesable]
//  Utilizada para errores de validación.

return response()->json(['errors' => array(['code' => 422,
 'message' => 'Faltan datos necesarios para el proceso de alta.'])], 422);
}

//insertamos un campo en community con create pasándole los datos recibidos, 
//con $request->all() tendremos todos los campos del formulario recibidos.

$nuevaComunidad = Fabricante::create($request->all());

// Devolvemos el código HTTP 201 Created – [Creada] Respuesta
//  a un POST que resulta en una creación. 
//  Debería ser combinado con un encabezado Location, apuntando 
//  a la ubicación del nuevo recurso.
$response = Response::make(json_encode(['data' => $nuevaComunidad]),
 201)->header('Location', 'http://localhost/comunidades/'
.$nuevaComunidad->id)->header('Content-Type', 'application/json');
return $response;
}


/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show($id) {
//muestra una comunidad con un id determinado
$comunidad = Community::find($id);
//en caso de no kexita esa comunidad devolverá un error
if (!$comunidad) {
//muestra un array de errores econtrados y la cabcera HTTP 404
return response()->json(['errors' => array(['code' => 404,
 'message' => 'No se encuentra una comunidad con ese código.'])], 404);
}

return response()->json(['status' => 'ok', 'data' => $comunidad], 200);
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id) {
//
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, $id) {
// return view("comunidades.update");
//se comprueba si exite el id de comunidad
$comunidad = Community::find($id);
if(!$comunidad){
return response()->
json(['errors' => array(['code' => 404,
 'message' => 'No se encuentra una comunidad con ese código.'])], 404);
$cad_ref_com = $request->input('cad_ref_com');
$address = $request->input('address');
$apart_num = $request->input('apart_num');

if ($request->method() === 'PATCH')
{
//control para modficar campos
$control = false;
if($cad_ref_com){
$comunidad->cad_ref_com = $cad_ref_com;
$control = true;
}
if($address){
$comunidad->address = $address;
$control = true;
}
if($apart_num){
$comunidad->apart_num = $apart_num;
$control = true;
}
if($control)
//almacenamos en la base de datos
$comunidad->save();
return response()->json(['status' => 'ok', 'data' => $comunidad], 200);
}
else
{
// Se devuelve un array errors con los errores encontrados y cabecera HTTP 304 Not Modified – [No Modificada]
//  Usado cuando el cacheo de encabezados HTTP está activo
// Este código 304 no devuelve ningún body, 
// así que si quisiéramos que se mostrara el mensaje usaríamos un código 200 en su lugar.
return response()->json(['errors' => array(['code' => 304, 
    'message' => 'No se ha modificado ningún dato de comunidad.'])], 304);
}
}


// Si el método no es PATCH entonces es PUT y tendremos que actualizar todos los datos.
if (!$cad_ref_com ||!$address ||!$apart_num)
{
// Se devuelve un array errors con los errores encontrados y cabecera 
// HTTP 422 Unprocessable Entity – [Entidad improcesable] Utilizada para
//  errores de validación.
return response()->json(['errors' => array(['code' => 422,
    'message' => 'Faltan valores para completar el procesamiento.'])], 422);
}

$comunidad->cad_ref_com = $cad_ref_com;
$comunidad->address = $address;
$comunidad->apart_num = $apart_num;

// Almacenamos en la base de datos el registro.
$comunidad->save();
return response()->json(['status' => 'ok', 'data' => $comunidad], 200);
}




/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id) {
//
    $comunidad= Community::find($id);
    //si no existe la comubidad se controla el error
    if($comunidad){
        return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
		}		
    }
    $apartamentos=$comunidad->property;
}


