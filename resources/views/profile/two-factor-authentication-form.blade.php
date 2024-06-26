<x-action-section>


    <x-slot name="content">
        <div class="card-body p-4">
            <h4 class="card-title mb-3">Two-factor Authentication</h4>
            <div class="d-flex align-items-center justify-content-between pb-2">
                @if ($this->enabled)
                    @if ($showingConfirmation)
                        <p class="card-subtitle fw-bold mb-0">{{ __('Finish enabling two factor authentication.') }}</p>
                    @else
                        <p class="card-subtitle fw-bold mb-0">{{ __('You have enabled two factor authentication.') }}</p>
                    @endif
                @else
                    <p class="card-subtitle fw-bold mb-0">{{ __('You have not enabled two factor authentication.') }}</p>
                @endif
            </div>
            <p>When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.</p>

            @if (! $this->enabled)
            <div class="d-flex align-items-center justify-content-between py-3 border-top border-bottom">
                <div>
                  <h5 class="fs-4 fw-semibold mb-0">Authentication App</h5>
                  <p class="mb-0">Google auth app</p>
                </div>
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <button class="btn bg-primary-subtle text-primary" type="button" wire:loading.attr="disabled">Setup</button>
                </x-confirms-password>
            </div>
                
            @endif

            @if ($this->enabled)
                @if ($showingQrCode)
                    <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                        <p class="font-semibold">
                            @if ($showingConfirmation)
                                {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
                            @else
                                {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
                            @endif
                        </p>
                    </div>

                    <div class="mt-4 p-2 inline-block bg-white">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>

                    <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                        <p class="font-semibold">
                            {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
                        </p>
                    </div>

                    @if ($showingConfirmation)
                        <div class="mt-4">
                            <x-label for="code" value="{{ __('Code') }}" />

                            <x-input id="code" type="text" name="code" class="form-control" inputmode="numeric" autofocus autocomplete="one-time-code"
                                wire:model="code"
                                wire:keydown.enter="confirmTwoFactorAuthentication" />

                            <x-input-error for="code" class="mt-2" />
                        </div>
                    @endif
                @endif

                @if ($showingRecoveryCodes)
                    <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                        <p class="font-semibold">
                            {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-gray-900 dark:text-gray-100 rounded-lg">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                @endif
            @endif

            <div class="mt-5">
                @if ($this->enabled)
                    @if ($showingRecoveryCodes)
                        <x-confirms-password wire:then="regenerateRecoveryCodes">
                            <x-secondary-button>
                                {{ __('Regenerate Recovery Codes') }}
                            </x-secondary-button>
                        </x-confirms-password>
                    @elseif ($showingConfirmation)
                        <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                            <x-button type="button" wire:loading.attr="disabled">
                                {{ __('Confirm') }}
                            </x-button>
                        </x-confirms-password>
                    @else
                        <x-confirms-password wire:then="showRecoveryCodes">
                            <x-secondary-button>
                                {{ __('Show Recovery Codes') }}
                            </x-secondary-button>
                        </x-confirms-password>
                    @endif

                    @if ($showingConfirmation)
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-danger-button wire:loading.attr="disabled">
                                {{ __('Cancel') }}
                            </x-danger-button>
                        </x-confirms-password>
                    @else
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-danger-button wire:loading.attr="disabled">
                                {{ __('Disable') }}
                            </x-danger-button>
                        </x-confirms-password>
                    @endif

                @endif
            </div>
            
        </div>
    </x-slot>
</x-action-section>
