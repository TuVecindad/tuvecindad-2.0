
@extends('layouts.controlador')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Propiedades</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('property.create') }}"> Create New Property</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Propiedad</th>
            <td>Nº Registro Catastral</td>
    
<!--            <th width="280px">Action</th>-->
        </tr>
        @foreach ($properties as $property)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $property->cad_ref_pro }}</td>
 
            <td>
                <form action="{{ route('property.destroy',$property->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('property.show',$property->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('property.edit',$property->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $properties->links() !!}
      
@endsection




  






