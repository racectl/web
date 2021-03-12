<!--  BEGIN SIDEBAR  -->
@inject('menu', 'MenuBuilder')
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            @foreach ($menu->getSections() as $section)
                @include($section->includeFile, ['section' => $section])
            @endforeach
        </ul>

    </nav>

</div>
<!--  END SIDEBAR  -->

