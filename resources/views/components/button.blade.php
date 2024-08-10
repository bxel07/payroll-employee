<!-- resources/views/components/button.blade.php -->
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-blue-500 text-white px-4 py-2 rounded']) }}>
    {{ $slot }}
</button>
