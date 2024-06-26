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
                    <h4 class="text-dark mb-5">Create New Password</h4>
                    
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="row">
                            {{-- <div class="form-group col-md-12 mb-4"> --}}
                                <div class="block">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <x-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                </div>

                                <div class="mt-4">
                                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <x-input id="password_confirmation" class="form-control block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                            {{-- </div> --}}
                            
                            <div class="col-md-12 mt-5">
                                <button type="submit" class="btn btn-primary btn-block mb-4 w-100">{{ __('Reset Password') }}</button>
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
