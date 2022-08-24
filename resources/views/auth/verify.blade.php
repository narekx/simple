
<div class="auth d-flex">
    <div class="d-flex flex-column justify-content-center align-items-center auth-content">

        <a class="auth-content__logo" href="/">
            <img src="{{asset('static/img/logo.svg')}}" width="180" alt="">
        </a>

        <h2 class="auth-content__title">{{ __('Շնորհակալություն') }}</h2>

        <div class="auth-content__form">
            @if (session('resent'))
                 <p class="text-center">
                    {{ __('Ձեր էլփոստի հասցեին ուղարկվել է նոր հաստատման հղում:') }}
                </p><br>
            @endif
            <p class="text-center">{!! __('Շարունակելուց առաջ խնդրում ենք անցնել Ձեր Էլ. փոստին  ուղարկված հղմամբ') !!}</p>
        </div>
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <p class="text-center">{{ __('Եթե նամակը չեք ստացել') }}<p>
            <button type="submit" class="btn btn-primary btn-sm w-100 mb-2">{{ __('Սեղմեք այստեղ՝ մեկ այլ պահանջելու համար') }}</button>.
        </form>

    </div>
</div>
