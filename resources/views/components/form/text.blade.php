<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <label for="{{ $wireTo }}">{{ $labeled }}</label>
    <input id="{{ $wireTo }}" wire:model.lazy="input.{{ $wireTo }}"
           type="text"
           class="form-control @error($wireTo) is-invalid @endError">
</div>
