<x-guest-layout>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10">
            <div class="card">
                <div class="card-header bg-secondary">
                    <div class="ec-brand">
                        <a href="#" title="Vhan">
                            <img class="ec-brand-icon" src="{{ asset('logo2.webp') }}" alt="" />
                        </a>
                    </div>
                </div>
                <div class="card-body p-5">
                    <h4 class="text-dark mb-5">Reset Password</h4>
                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>
                    
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block mb-4 w-100">{{ __('Email Password Reset Link') }}</button>
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <x-validation-errors class="mb-4" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
