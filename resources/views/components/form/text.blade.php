<div class="col-xl-{{ $width }} col-lg-12">
    <div class="form-group">
        <label>{{ $labeled }}</label>
        <input wire:model.lazy="input.{{ $wireTo }}" type="text" class="form-control">
    </div>
</div>