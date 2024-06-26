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
                    <h4 class="text-dark mb-5">Sign Up</h4>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <x-label for="name" value="{{ __('Name') }}" />
                                <x-input id="name" class="form-control" type="text" placeholder="Enter your Name" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>

                            <div class="form-group col-md-12">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="form-control" type="email" placeholder="Enter your Email" name="email" :value="old('email')" required autocomplete="username" />
                            </div>

                            <div class="form-group col-md-12">
                                <x-label for="phone" value="{{ __('Phone Number') }}" />
                                <x-input id="phone" class="form-control" type="text" placeholder="Enter your Phone Number" name="phone" :value="old('phone')" required autocomplete="phone" />
                            </div>
                            
                            <div class="form-group col-md-12 ">
                                <x-label for="password" value="{{ __('Password') }}" />
                                <x-input id="password" class="form-control" placeholder="Create Password" type="password" name="password" required autocomplete="new-password" />
                            </div>

                            <div class="form-group col-md-12 ">
                                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-input id="password_confirmation" placeholder="Confirm Password" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block mb-4">{{ __('Register') }}</button>
                                <p class="sign-upp">{{ __('Already registered?') }}
                                   <a class="text-blue" href="{{ route('login') }}">Sign in</a>
                                </p>
                            </div>

                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            <div class="col-md-12">
                                <x-validation-errors class="my-2" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
