<x-auth>
    <x-slot:title>{{ __('Login') }}</x-slot:title>
    <x-slot:content>
    <section class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <x-form class="theme-form login-form" method="POST" action="{{ route('login') }}">
                        <div class="card-body p-0">
                            <div class="mb-4 text-center p-0">
                                <img src="{{asset('assets/images/logo/logo.svg')}}"
                                        style="max-width: 200px; width: auto" alt="logo" class="img-fluid"></a>
                            </div>
                        </div>
                        <h4>Login</h4>
                        <h6>Welcome back! Log in to your account.</h6>
                        <div class="form-group">
                            <x-label for="{{ __('Email Address') }}" />
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <x-input name="email" type="email" class="form-control" placeholder="Test@gmail.com" autocomplete="email" required />
                            </div>
                            <x-error field="email" class="text-danger is-invalid" />
                        </div>
                        <div class="form-group">
                            <x-label for="{{ __('Password') }}" />
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="icon-lock"></i>
                                </span>
                                <x-input name="password" class="form-control" type="password" required placeholder="*********" />
                                <div class="show-hide">
                                    <span class="show"></span>
                                </div>
                            </div>
                            <x-error field="password" class="text-danger is-invalid" />
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                                <label for="checkbox1">{{ __('Remember password') }}</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">{{ __('Login') }}</button>
                        </div>
                        {{-- <p>Don't have account?<a class="ms-2" href="{{ route('register') }}">Create Account</a></p> --}}
                    </x-form>
                </div>
            </div>
        </div>
    </section>
    </x-slot:content>
</x-auth>
