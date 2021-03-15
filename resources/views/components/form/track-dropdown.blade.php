<label>Track</label>
<select class="form-control">
    @foreach($tracks as $track)
        <option value="{{ $track->gameConfigId }}">{{ $track->name }}</option>
    @endforeach
</select>
