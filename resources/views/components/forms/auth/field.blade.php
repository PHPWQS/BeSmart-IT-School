<div class="row mb-3">
    <div class="field border-2 rounded-md mb-3">
        <input {{ $attributes }} class="w-full rounded-md pl-2 py-2">
    </div>
    @error($attributes['name'])
      <div class="error mt-2 pl-2">
        <span class="font-bold text-red-800">{{ $message }}</span>
      </div>
    @enderror
</div>