<label for="track-selection">Track</label>
<select @if($wireTo)wire:model="input.{{ $wireTo }}"@endif class="form-control" id="track-selection">
    @foreach($tracks as $track)
        <option value="{{ $track->gameConfigId }}">{{ $track->name }}</option>
    @endforeach
</select>
