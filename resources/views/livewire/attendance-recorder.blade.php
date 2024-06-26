<div>
    @if($allowSignOff==0)
    <button class="btn {{ $buttonClass }} btn-sm" wire:click="handleButtonClick">{{ $buttonLabel }}</button>
    @endif
    @if($allowSignOff==1)
    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#notesmodel" data-toggle="modal" data-target="#notesmodel">Sign Off</button>

    
    <style>
        /* .modal-backdrop.show {
            display: none;
        } */
    </style>
    
    @endif
</div>
