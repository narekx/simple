@extends('layouts.site')

@section('title') Գաղտնաբառի վերականգնում @endsection

@section('content')
@include('partials.header')

<div class="auth d-flex">
    <div class="d-flex flex-column justify-content-center align-items-center auth-content">
        @if (session('status'))
        <div class="alert alert-success text-center mb-3" role="alert">
            {{ __(session('status')) }}
        </div>
        @endif

        <a class="auth-content__logo" href="/">
            <img src="{{asset('static/img/logo.svg')}}" width="180" alt="">
        </a>

        <h2 class="auth-content__title">{{ __('Գաղտնաբառի վերականգնում') }}</h2>

        <form method="POST" class="auth-content__form" action="{{ route('password.email') }}">
            @csrf
            <div class="input-group has-validation mb-3">
                <input placeholder="Էլ. փոստ" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit"  class="btn btn-primary btn-sm w-100">{{ __('Հաստատել') }}</button>

        </form>

    </div>
</div>

@include('partials.footer')
@endsection
