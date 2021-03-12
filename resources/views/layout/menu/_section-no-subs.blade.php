<li class="menu">
    <a href="{{ $section->link }}" @if($section->active) data-active="true" @endif aria-expanded="{{ $section->active }}" class="dropdown-toggle">
        <div class="">
            <i data-feather="{{ $section->icon }}"></i>
            <span>{{ $section->title }}</span>
        </div>
    </a>
</li>
