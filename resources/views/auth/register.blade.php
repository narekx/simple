
    <div class="auth d-flex">
        <div class="d-flex flex-column justify-content-between align-items-center auth-content">
            <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 mb-3">

                <a class="auth-content__logo" href="/">
                    <img src="{{asset('static/img/logo.svg')}}" width="180" alt="">
                </a>

                <h2 class="auth-content__title">Գրանցում</h2>

                <form class="auth-content__form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group has-validation mb-3">
                        <input placeholder="Ազգանուն" id="last_name" type="text"
                               class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                               value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                        @error('last_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="input-group has-validation mb-3">
                        <input placeholder="Անուն" id="first_name" type="text"
                               class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                               value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                        @error('first_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="input-group has-validation mb-3">
                        <input placeholder="Էլ. փոստ" id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="input-group has-validation mb-3">
                        <input placeholder="Գաղտնաբառ" id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password" required
                               autocomplete="new-password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm w-100">{{ __('Գրանցվել') }}</button>

                </form>
            </div>
            <div class="text-center">
                <span>Արդեն գրանցված եք ?</span>
                <a class="auth-content__link" href="{{ route('login') }}">Մուտք</a>
            </div>
        </div>
    </div>
