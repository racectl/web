<li @if($entry->active) class="active" @endif>
    <a href="{{ $entry->link }}"> {{ $entry->title }} </a>
</li>
