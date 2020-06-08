@extends('layouts.dashboard')

@section('content')
<script>
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    })
</script>
<div class="uper table-responsive">

    @if(session()->get('success'))
    <div class="alert2 alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
    <table class="table table-striped text-nowrap">
        <thead>
            <tr>
                <td>ID</td>
                <td>Referencia catastral</td>
                <td>Comunidad</td>
                <td>Propietario</td>
                <td>Inquilino</td>
                <td colspan="1">Datos</td>
                <td colspan="2">Acción</td>
            </tr>
        </thead>
        <tbody>

            @if(auth()->user()->hasRole('superadmin'))

            @foreach($properties as $property)
            <tr>
                <td>{{$property->id}}</td>
                <td>{{$property->cad_ref_pro}}</td>
                <td>{{$property->com_id}}</td>
                <td>{{$property->owner}}</td>
                <td>{{$property->tenant}}</td>

                @if ($property->house_id != null)
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            Inmueble
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <table class="table text-nowrap mb-0">
                                <thead>
                                    <td>Piso</td>
                                    <td>Puerta</td>
                                    <td>M<sup>2</sup></td>
                                    <td>Habitaciones</td>
                                    <td>Baños</td>
                                    <td>Ocupantes</td>
                                    <td>Tipo</td>
                                </thead>
                                <tbody>
                                    <td>{{$property->getdata('house','floor')}}</td>
                                    <td>{{$property->getdata('house','door')}}</td>
                                    <td>{{$property->getdata('house','sqm')}}</td>
                                    <td>{{$property->getdata('house','room')}}</td>
                                    <td>{{$property->getdata('house','bathroom')}}</td>
                                    <td>{{$property->getdata('house','occupants')}}</td>
                                    <td>{{$property->getdata('house','type')}}</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                @elseif ($property->parking_id != null)
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            Parking
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <table class="table text-nowrap mb-0">
                                <thead>
                                    <td>M<sup>2</sup></td>
                                    <td>Número</td>
                                </thead>
                                <tbody>
                                    <td>{{$property->getdata('parking','num_p')}}</td>
                                    <td>{{$property->getdata('parking','sqm_p')}}</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                @elseif ($property->storage_id != null)
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            Trastero
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <table class="table text-nowrap mb-0">
                                <thead>
                                    <td>M<sup>2</sup></td>
                                    <td>Número</td>
                                </thead>
                                <tbody>
                                    <td>{{$property->getdata('storage','num_s')}}</td>
                                    <td>{{$property->getdata('storage','sqm_s')}}</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                @endif

                @if(auth()->user()->hasRoleProperty($property->id,2))
                <td><a href="{{ route('properties.edit', $property->id)}}" class="btn btn-primary">Editar</a></td>
                <td>
                    <button class="btn btn-danger white" type="submit" data-toggle="modal" data-target="#removeModal">Eliminar</button>
                    <form id="remove-form" action="{{ route('properties.destroy', $property->id)}}" method="post" class="mb-0">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
                @elseif(auth()->user()->hasRoleProperty($property->id,3))
                <td><a href="{{ route('properties.edit', $property->id)}}" class="btn btn-primary">Editar</a></td>
                <td><a href="#" class="btn btn-danger disabled">Eliminar</a></td>
                @else
                <td><a href="#" class="btn btn-primary disabled">Editar</a></td>
                <td><a href="#" class="btn btn-danger disabled">Eliminar</a></td>
                @endif
            </tr>
            @endforeach

            @else

            @foreach(Auth::user()->properties as $property)
            <tr>
                <td>{{$property->id}}</td>
                <td>{{$property->cad_ref_pro}}</td>
                <td>{{$property->com_id}}</td>
                <td>{{$property->owner}}</td>
                <td>{{$property->tenant}}</td>

                @if ($property->house_id != null)
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            Inmueble
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <table class="table text-nowrap mb-0">
                                <thead>
                                    <td>Piso</td>
                                    <td>Puerta</td>
                                    <td>M<sup>2</sup></td>
                                    <td>Habitaciones</td>
                                    <td>Baños</td>
                                    <td>Ocupantes</td>
                                    <td>Tipo</td>
                                </thead>
                                <tbody>
                                    <td>{{$property->getdata('house','floor')}}</td>
                                    <td>{{$property->getdata('house','door')}}</td>
                                    <td>{{$property->getdata('house','sqm')}}</td>
                                    <td>{{$property->getdata('house','room')}}</td>
                                    <td>{{$property->getdata('house','bathroom')}}</td>
                                    <td>{{$property->getdata('house','occupants')}}</td>
                                    <td>{{$property->getdata('house','type')}}</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                @elseif ($property->parking_id != null)
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            Parking
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <table class="table text-nowrap mb-0">
                                <thead>
                                    <td>M<sup>2</sup></td>
                                    <td>Número</td>
                                </thead>
                                <tbody>
                                    <td>{{$property->getdata('parking','num_p')}}</td>
                                    <td>{{$property->getdata('parking','sqm_p')}}</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                @elseif ($property->storage_id != null)
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            Trastero
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <table class="table text-nowrap mb-0">
                                <thead>
                                    <td>M<sup>2</sup></td>
                                    <td>Número</td>
                                </thead>
                                <tbody>
                                    <td>{{$property->getdata('storage','num_s')}}</td>
                                    <td>{{$property->getdata('storage','sqm_s')}}</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                @endif

                @if(auth()->user()->hasRoleProperty($property->id,2))
                <td><a href="{{ route('properties.edit', $property->id)}}" class="btn btn-primary">Editar</a></td>
                <td>
                    <button class="btn btn-danger white" type="submit" data-toggle="modal" data-target="#removeModal">Eliminar</button>
                    <form id="remove-form" action="{{ route('properties.destroy', $property->id)}}" method="post" class="mb-0">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
                @elseif(auth()->user()->hasRoleProperty($property->id,3))
                <td><a href="{{ route('properties.edit', $property->id)}}" class="btn btn-primary">Editar</a></td>
                <td><a href="#" class="btn btn-danger disabled">Eliminar</a></td>
                @else
                <td><a href="#" class="btn btn-primary disabled">Editar</a></td>
                <td><a href="#" class="btn btn-danger disabled">Eliminar</a></td>
                @endif
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    {{ $properties->links() }}

</div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection