<div>

    @if ($default)
        
        <label for="{{ $name }}" class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" value="" @checked(!request($name))>
            <span class="ml-2">All</span>
        </label>
        
    @endif
    

    @foreach ($options_with_labels as $key => $label)
        <label for="{{ $key }}" class="mb-1 flex items-center">
            <input 
                type="radio" 
                name="{{ $name }}" 
                value="{{ $key }}"
                id={{ $key }} 
                @checked(($value ?? request($name)) === $key)
            >
            <span class="ml-2">{{ Str::ucFirst($label) }}</span>
        </label>

    @endforeach

    @error($name)
        <div class="mt-1 text-xs text-red-500">
            {{ $message }}
        </div>
    @enderror


</div>