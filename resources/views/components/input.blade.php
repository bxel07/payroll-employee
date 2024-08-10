<!-- resources/views/components/input.blade.php -->
<input 
    id="{{ $id }}" 
    class="{{ $class }}" 
    type="{{ $type }}" 
    name="{{ $name }}" 
    value="{{ $value ?? old($name) }}" 
    {{ $attributes->merge(['class' => 'form-input']) }} 
/>
