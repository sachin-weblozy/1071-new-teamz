@props(['submit'])

<div>
    <form wire:submit="{{ $submit }}">
        <div class="{{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
            <div class="">
                {{ $form }}
            </div>
        </div>

        @if (isset($actions))
            <div class="d-flex align-items-center justify-content-center my-4 gap-6">
                {{ $actions }}
            </div>
        @endif
    </form>
</div>
