
@extends('layouts.controlador')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Mostrar propiedad</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('property.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>REferencia catastral:</strong>
                {{ $property->cad_ref_pro }}
            </div>
        </div>
<!--        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $product->detail }}
            </div>
        </div>-->
    </div>
@endsection