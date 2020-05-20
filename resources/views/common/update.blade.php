@extends('layouts.controlador')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Editar:
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('common.update') }}">
          <div class="form-group">
              @csrf
              <label for="name">Comunidad:</label>
              <input type="text" class="form-control" name="comunidad"/>
              <p>Introduce 1 si dispone de area común y 0 si no la tiene</p>
          </div>
          <div class="form-group">
              <label for="name">Piscina:</label>
              <input type="text" class="form-control" name="piscina"/>
          </div>
          <div class="form-group">
              <label for="price">Gym:</label>
              <input type="text" class="form-control" name="gym"/>
          </div>
          <div class="form-group">
              <label for="quantity">Hall:</label>
              <input type="text" class="form-control" name="hall"/>
          </div>
           <div class="form-group">
              <label for="quantity">Azotea:</label>
              <input type="text" class="form-control" name="azotea"/>
          </div>
           <div class="form-group">
              <label for="quantity">Jardin:</label>
              <input type="text" class="form-control" name="jardin"/>
          </div>
          <button type="submit" class="btn btn-primary">Editar</button>
      </form>
  </div>
</div>
@endsection
