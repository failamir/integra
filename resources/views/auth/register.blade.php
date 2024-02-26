@extends('layouts.auth')
@section('page-title')
    {{ __('Register') }}
@endsection
@php
      $settings = Utility::settings();
    $logo = \App\Models\Utility::get_file('uploads/logo');
@endphp
@push('custom-scripts')
@if ($settings['recaptcha_module'] == 'on')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush
{{-- @section('language-bar')

    <li class="nav-item">
        <select class="btn btn-primary ms-2 me-2 language_option_bg text-center" style="text-align-last: center;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" id="language">
            @foreach (Utility::languages() as $code => $language)
                <option class="text-center" @if ($lang == $code) selected @endif value="{{ route('register',$code) }}">{{ucfirst($language)}}</option>
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
                <a href="{{ route('register',$code) }}" tabindex="0"
                    class="dropdown-item ">
                    <span>{{ Str::ucfirst($language) }}</span>
                </a>
                @endforeach
            </div>
        </li>
    </div>
@endsection

@section('content')
    <div class="card-body">
        <div>
            <h2 class="mb-3 f-w-600">{{ __('Register') }}</h2>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @if (session('status'))
                <div class="mb-4 font-medium text-lg text-green-600 text-danger">
                    {{ __('Email SMTP settings does not configured so please contact to your site admin.') }}
                </div>
            @endif
            @csrf
            <div class="">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">{{__('Name')}}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{__('Enter Name')}}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">{{__('Email')}}</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{__('Enter Email')}}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                    <div class="invalid-feedback">
                        {{__('Please fill in your email')}}
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">{{__('Password')}}</label>
                    <input id="password" type="password" data-indicator="pwindicator" class="form-control pwstrength @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{__('Enter Password')}}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                    <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">{{__('Password Confirmation')}}</label>
                    <input id="password_confirmation" type="password" data-indicator="password_confirmation" class="form-control pwstrength @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="{{__('Enter Confirm Password')}}">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                    <div id="password_confirmation" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                </div>
                @if ($settings['recaptcha_module'] == 'on')
                    <div class="form-group mb-3">
                        {!! NoCaptcha::display($settings['cust_darklayout']=='on' ? ['data-theme' => 'dark'] : []) !!}
                        @error('g-recaptcha-response')
                        <span class="small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                @endif
    
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block mt-2">{{__('Register')}}</button>
                </div>
    
            </div>
            <p class="my-4 text-center">{{__("Already have an account?")}} <a href="{{ route('login',$lang) }}" class="text-primary">{{__('Login')}}</a></p>
        </form>

    </div>
@endsection

