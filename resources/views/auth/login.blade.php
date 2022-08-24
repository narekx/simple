<div class="auth d-flex">
    <div class="d-flex flex-column justify-content-center align-items-center auth-content">

        <a class="auth-content__logo" href="/">
            <img src="{{asset('static/img/logo.svg')}}" width="180" alt="">
        </a>

        <h2 class="auth-content__title">Բարի գալուստ</h2>

        <form class="auth-content__form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group has-validation mb-3">
                <input  placeholder="Էլ. փոստ"  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="input-group has-validation mb-2">
                <input  placeholder="Գաղտնաբառ" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <!--<div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                    </label>
                            </div>
                    </div>
            </div>-->
            @if (Route::has('password.request'))
            <div class="text-end mb-2">
                <a class="auth-content__link" href="{{ route('password.request') }}">{{ __('Մոռացել եք գաղտնաբառը՞') }}</a>
            </div>
            @endif



            <button type="submit" class="btn btn-primary btn-sm w-100 mb-2">Մուտք</button>

            <div class="text-center">
                <a class="auth-content__link" href="{{ route('register') }}">Դեռ չունեք հաշիվ?</a>
            </div>

        </form>

    </div>
</div>
