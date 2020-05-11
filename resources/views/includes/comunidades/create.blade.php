
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crear comunidad') }}</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('includes.comunidades.create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="cad_ref_com" class="col-md-4 col-form-label text-md-right">{{ __('Registro catastral') }}</label>

                            <div class="col-md-6">
                                <input id="cad_ref_com" type="text" class="form-control @error('name') is-invalid @enderror" name="cad_ref_com" value="{{ old('cad_ref_com') }}" required autocomplete="cad_ref_com" autofocus>

                                @error('cad_nom_ref')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                       

                        <div class="form-group row">
                            <label for="surname1" class="col-md-4 col-form-label text-md-right">{{ __('Surname1') }}</label>

                            <div class="col-md-6">
                                <input id="surname1" type="text" class="form-control @error('suname1') is-invalid @enderror" name="surname1" value="{{ old('surname1') }}" required autocomplete="surname1" autofocus>

                                @error('surname1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="surname2" class="col-md-4 col-form-label text-md-right">{{ __('Surname2') }}</label>

                            <div class="col-md-6">
                                <input id="surname2" type="text" class="form-control @error('suname2') is-invalid @enderror" name="surname2" value="{{ old('surname2') }}" required autocomplete="surname2" autofocus>

                                @error('surname2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nif" class="col-md-4 col-form-label text-md-right">{{ __('NIF') }}</label>

                            <div class="col-md-6">
                                <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ old('nif') }}" required autocomplete="nif" autofocus>

                                @error('nif')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="phone1" class="col-md-4 col-form-label text-md-right">{{ __('Phone1') }}</label>

                            <div class="col-md-6">
                                <input id="phone1" type="text" class="form-control @error('phone1') is-invalid @enderror" name="phone1" value="{{ old('phone1') }}" required autocomplete="phone1" autofocus>

                                @error('phone1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 
                                   <div class="form-group row">
                            <label for="phone2" class="col-md-4 col-form-label text-md-right">{{ __('Phone2') }}</label>

                            <div class="col-md-6">
                                <input id="phone2" type="text" class="form-control @error('phone2') is-invalid @enderror" name="phone2" value="{{ old('phone2') }}" required autocomplete="phone2" autofocus>

                                @error('phone2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

