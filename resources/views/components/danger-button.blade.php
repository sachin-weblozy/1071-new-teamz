<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn bg-danger-subtle text-danger']) }}>
    {{ $slot }}
</button>
