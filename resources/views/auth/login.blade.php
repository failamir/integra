@extends('layouts.auth')
@php
    use App\Models\Utility;
    $logo = \App\Models\Utility::get_file('uploads/logo');
    $settings = Utility::settings();
    $company_logo = $settings['company_logo'] ?? '';

@endphp
@push('custom-scripts')
@if ($settings['recaptcha_module'] == 'on')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush
@section('page-title')
    {{ __('Login') }}
@endsection

{{-- @section('auth-topbar')
    <li class="nav-item">
        <select class="btn btn-primary ms-2 me-2 language_option_bg text-center" style="text-align-last: center;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" id="language">
            @foreach (Utility::languages() as $code => $language)
                <option class="text-center" @if ($lang == $code) selected @endif value="{{ route('login',$code) }}">{{ucfirst($language)}}</option>
            @endforeach
        </select>
    </li>

@endsection --}}
@php
    $languages = App\Models\Utility::languages();

@endphp
@section('language-bar')
    <div class="lang-dropdown-only-desk">
        <li class="dropdown dash-h-item drp-language">
            <a class="dash-head-link dropdown-toggle btn" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="drp-text"> {{ $languages[$lang] }}
                </span>
            </a>
            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                @foreach($languages as $code => $language)
                <a href="{{ route('login',$code) }}"tabindex="0"
                class="dropdown-item ">
                <span>{{ Str::upper($language) }}</span>
            </a>
                @endforeach
            </div>
        </li>
    </div>
@endsection

@section('content')
    <div class="card-body">
        <div>
            <h2 class="mb-3 f-w-600">{{ __('Login') }}</h2>
        </div>
        {{ Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginForm', 'class' => 'login-form']) }}
        @if (session('status'))
        <div class="mb-4 font-medium text-lg text-green-600 text-danger">
            {{session('status') }}
        </div>
    @endif
        <div class="custom-login-form">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Email') }}</label>
                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Your Email')]) }}
                @error('email')
                    <span class="error invalid-email text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Password') }}</label>
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Your Password'), 'id' => 'input-password']) }}
                @error('password')
                    <span class="error invalid-password text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                   
                    @if (Route::has('password.request'))
                        <span><a href="{{ route('password.request',$lang) }}"
                                tabindex="0">{{ __('Forgot your password?') }}</a></span>
                    @endif
                </div>
            </div>


            @if ($settings['recaptcha_module'] == 'on')
                <div class="form-group col-lg-12 col-md-12 mt-3">
                     {!! NoCaptcha::display($settings['cust_darklayout']=='on' ? ['data-theme' => 'dark'] : []) !!}
                    @error('g-recaptcha-response')
                        <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endif

            <div class="d-grid">
                {{ Form::submit(__('Login'), ['class' => 'btn btn-primary mt-2', 'id' => 'saveBtn']) }}
            </div>
            @if ($settings['enable_signup'] == 'on')
            <p class="my-4 text-center">{{ __("Don't have an account?") }}
                <a href="{{ route('register',$lang) }}" class="text-primary">{{__('Register')}}</a>
            </p>
        @endif
        </div>
        {{ Form::close() }}
    </div>
@endsection

{{-- @section('content')

    <div class="">
        <h2 class="mb-3 f-w-600">{{__('Login')}}</h2>
    </div>
    {{Form::open(array('route'=>'login','method'=>'post','id'=>'loginForm' ))}}
    @csrf
    <div class="">
        <div class="form-group mb-3">
            <label for="email" class="form-label">{{__('Email')}}</label>
            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="password" class="form-label">{{__('Password')}}</label>
            <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
            <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror

        </div>

        @if (env('RECAPTCHA_MODULE') == 'on')
            <div class="form-group mb-3">
                {!! NoCaptcha::display() !!}
                @error('g-recaptcha-response')
                <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
        @endif
        <div class="form-group mb-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs">{{ __('Forgot Your Password?') }}</a>
            @endif

        </div>
        <div class="d-grid">
            <button type="submit" class="btn-login btn btn-primary btn-block mt-2" id="login_button">{{__('Login')}}</button>
        </div>
        @if ($settings['enable_signup'] == 'on')

        <p class="my-4 text-center">{{__("Don't have an account?")}} <a href="{{ route('register',$lang) }}" class="text-primary">{{__('Register')}}</a></p>
        @endif

    </div>
    {{Form::close()}}
@endsection --}}

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#form_data").submit(function(e) {
            $("#login_button").attr("disabled", true);
            return true;
        });
    });
</script>
