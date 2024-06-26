<x-form-section submit="updateProfileInformation">

    <x-slot name="form">
        <!-- Profile Photo -->
        <div class="row">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="col-md-6">
                    <input type="file" id="photo" class="d-none hidden"
                                wire:model.live="photo"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />
                    <div class="w-100  position-relative overflow-hidden">
                        <div class="card-body p-4">
                            <h4 class="card-title">Change Profile</h4>
                            <p class="card-subtitle mb-4">Change your profile picture from here</p>

                            <div class="text-center">
                                <div x-show="! photoPreview">
                                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="img-fluid rounded-circle" width="120" height="120">
                                </div>
                                <!-- New Profile Photo Preview -->
                                <div class="mt-2" x-show="photoPreview" style="display: none;">
                                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">1
                                    </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-center my-4 gap-6">
                                    <button class="btn btn-primary" type="button" x-on:click.prevent="$refs.photo.click()">Upload</button>
                                    @if ($this->user->profile_photo_path)
                                        <x-danger-button type="button" wire:click="deleteProfilePhoto">
                                            {{ __('Remove Photo') }}
                                        </x-danger-button>
                                    @endif
                                    {{-- <button class="btn bg-danger-subtle text-danger">Reset</button> --}}
                                </div>
                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                <x-input-error for="photo" class="mt-2" />
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-6">
                <div class="w-100 position-relative overflow-hidden">
                    <div class="card-body p-4">
                        <h4 class="card-title">Personal Details</h4>
                        <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Your Name') }}</label>
                            <input type="text" class="form-control" id="name" wire:model="state.name" required autocomplete="name" />
                            <x-input-error for="name" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" wire:model="state.email" required autocomplete="username" />
                            <x-input-error for="email" class="mt-2" />

                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                                <p class="text-sm mt-2 dark:text-white">
                                    {{ __('Your email address is unverified.') }}

                                    <button type="button" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" wire:click.prevent="sendEmailVerification">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if ($this->verificationLinkSent)
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            @endif
                        </div>
                        <div>
                            <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                            <input type="text" class="form-control" id="phone" wire:model="state.phone" required autocomplete="phone" />
                            <x-input-error for="phone" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo" class="btn btn-primary">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
