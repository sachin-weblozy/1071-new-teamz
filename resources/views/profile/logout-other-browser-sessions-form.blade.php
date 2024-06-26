<x-action-section>

    <x-slot name="content">
        <div class="card-body p-4">
            <div class="text-bg-light rounded-1 p-6 d-inline-flex align-items-center justify-content-center mb-3">
              <i class="ti ti-device-laptop text-primary d-block fs-7" width="22" height="22"></i>
            </div>
            <h4 class="card-title mb-0">Browser Sessions</h4>
            <p class="mb-3">Manage and log out your active sessions on other browsers and devices.</p>
            <p>If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.</p>

            
            
        

            @if (count($this->sessions) > 0)
                    <!-- Other Browser Sessions -->
                    @foreach ($this->sessions as $session)
                        <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                @if ($session->agent->isDesktop())
                                <i class="ti ti-device-mobile text-dark d-block fs-7" width="26" height="26"></i>
                                @else
                                <i class="ti ti-device-mobile text-dark d-block fs-7" width="26" height="26"></i>
                                @endif

                                <div>
                                    <h5 class="fs-4 fw-semibold mb-0">{{ $session->agent->platform() ? $session->agent->platform() : __('Unknown') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Unknown') }}</h5>
                                    <p class="mb-0">
                                        IP Address: {{ $session->ip_address }},
                                        @if ($session->is_current_device)
                                            <span class="text-success font-semibold">{{ __('This device') }}</span>
                                        @else
                                            {{ __('Last active') }} {{ $session->last_active }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                <button class="btn bg-primary-subtle text-primary w-100 py-1 mt-3">Need Help ?</button>
            @endif

            <div class="flex items-center mt-5">

                <button class="btn btn-primary" wire:click="confirmLogout" wire:loading.attr="disabled">Sign out from all devices</button>

                <x-action-message class="ms-3" on="loggedOut">
                    {{ __('Done.') }}
                </x-action-message>
            </div>
         </div>
        <!-- Log Out Other Devices Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingLogout">
            <x-slot name="title">
                {{ __('Log Out Other Browser Sessions') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="form-control"
                                autocomplete="current-password"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn bg-danger-subtle text-danger" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">Cancel</button>

                <x-button class="btn btn-primary"
                            wire:click="logoutOtherBrowserSessions"
                            wire:loading.attr="disabled">
                    {{ __('Log Out Other Browser Sessions') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
