@props(['name', 'options', 'selected' => null])

<select {{ $attributes->merge(['class' => 'block mt-1 w-full']) }} name="{{ $name }}">
    @foreach($options as $key => $value)
    <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>

@error($name)
<p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror