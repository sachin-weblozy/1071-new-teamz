<x-form-section submit="updatePassword">
        
    <x-slot name="form">

        <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="current_password" wire:model="state.current_password" autocomplete="current-password" />
        <x-input-error for="current_password" class="mt-2" />
        </div>
        <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">New Password</label>
        <input type="password" class="form-control" id="exampleInputPassword2" wire:model="state.password" autocomplete="new-password" />
        <x-input-error for="password" class="mt-2" />
        </div>
        <div>
        <label for="exampleInputPassword3" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="exampleInputPassword3" wire:model="state.password_confirmation" autocomplete="new-password" />
        <x-input-error for="password_confirmation" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button class="btn btn-primary">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
