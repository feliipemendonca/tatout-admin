<x-auth>
    <x-slot:title>{{ __('Redefinir Senha') }}</x-slot:title>
    <x-slot:content>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div class="login-main">
                        <x-form class="theme-form login-form" method="POST" action="{{ route('password.update') }}">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <h4 class="mb-3">{{ __('Reset Your Password') }}</h4>
                            <div class="form-group">
                                <x-label for="{{ __('Email Address') }}" />
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-email"></i></span>
                                    <x-input name="email" type="email" class="form-control" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus />
                                </div>
                                <x-error field="email" class="text-danger is-invalid" />
                            </div>

                            <div class="form-group">
                                <x-label for="{{ __('Password') }}" />
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icon-lock"></i>
                                    </span>
                                    <x-input name="password" class="form-control" type="password" placeholder="*********" required autocomplete="new-password"/>
                                    <div class="show-hide">
                                        <span class="show"></span>
                                    </div>
                                </div>
                                <x-error field="password" class="text-danger is-invalid" />
                            </div>

                            <div class="form-group">
                                <x-label for="{{ __('Confirm Password') }}" />
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icon-lock"></i>
                                    </span>
                                    <x-input name="password_confirmation" class="form-control" type="password" placeholder="*********" required autocomplete="new-password"/>
                                    <div class="show-hide">
                                        <span class="show"></span>
                                    </div>
                                </div>
                                <x-error field="password" class="text-danger is-invalid" />
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">{{ __('Reset Password') }}</button>
                            </div>
                            <p>Already have an password?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </x-slot:content>
</x-auth>
