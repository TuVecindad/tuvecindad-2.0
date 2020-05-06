<div id="mobile-logo" class="col-md-2">
    <a href="#">
        <img class="m-2" src="{{ asset('images/logo.png') }}" height="49px" width="50px">
    </a>
</div>
<div class="offset-md-3 col-md-2">
    <h3 class="text-light text-center m-auto">
        {{ config('app.name') }}
    </h3>
</div>
<div class="offset-md-2 col-md-3">
    <nav id="mobile-login" class="navbar navbar-dark justify-content-end">
        @if (Route::has('login'))

        @auth
        <a class="navbar-brand p-0" href="{{ url('/home') }}">Dashboard</a>

        <a class="navbar-brand p-0" href="{{ route('logout') }}"  data-toggle="modal" data-target="#exampleModal">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @else
        <a class="navbar-brand p-0" href="{{ route('login') }}">Login</a>

        @if (Route::has('register'))
        <a class="navbar-brand p-0" href="{{ route('register') }}">Registrarse</a>
        @endif
        @endauth

        @endif
    </nav>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cierre de sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Quieres cerrar tu sesión?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar sesión</button>
      </div>
    </div>
  </div>
</div>