<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout._head')
</head>
<body>
    @include('layout._loader')

    @include('layout._top-header')

    @include('layout._menu-title-bar')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('layout._sidebar')

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing layout-top-spacing">
                @yield('content')
            </div>
            @include('layout._footer')
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    @include('layout._scripts')
</body>
</html>
