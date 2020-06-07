@extends('layouts.welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica tu correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Te acabamos de enviar un link a tu correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de seguir, por favor, revisa tu email para el enlace de verificación.') }}
                    {{ __('Si no has recibido el correo') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('haz click aquí para que te lo volvamos a enviar') }}</button>.
                    </form>
                    <div>
                        <a href="{{ route('users.edit', Auth::id()) }}" class="btn btn-primary float-right">Continuar sin verificar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
