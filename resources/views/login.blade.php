@php use Illuminate\Support\Facades\View; @endphp
@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))
@php($password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset'))

@if (config('adminlte.use_route_url', false))
    @php($login_url = route('login'))
    @php($register_url = route('register'))
    @php($password_reset_url = route('password.request'))
@else
    @php($login_url = url($login_url))
    @php($register_url = url($register_url))
    @php($password_reset_url = url($password_reset_url))
@endif

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')
    @error('login_error')
    <div class="alert alert-warning alert-dismissable fade show" role="alert">
        <span class="alert-inner--text"><strong>Warning!</strong> {{$message}}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                &times;
            </span>
        </button>
    </div>
    @enderror
    <form action="{{ route('login.post') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input
                type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                value="{{ old('username') }}" placeholder="Nama" autofocus
            >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('username'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('username') }}</strong>
                </div>
            @endif
        </div>
        <div class="input-group mb-3">
            <input
                type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                placeholder="{{ __('adminlte::adminlte.password') }}"
            >
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">
                        {{ __('adminlte::adminlte.remember_me') }}
                    </label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>
    </form>
@endsection

@section('auth_footer')
    @if (config('adminlte.register_url', 'register'))
        <p class="my-0">
            <a href="{{ $register_url }}">
                {{ __('adminlte::adminlte.register_a_new_membership') }}
            </a>
        </p>
    @endif
@endsection
