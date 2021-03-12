<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>RaceCtl</title>
<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}"/>
<link href="{{ asset('css/loader.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/loader.js') }}"></script>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="{{ asset('plugins/sweetalerts/promise-polyfill.js') }}"></script>
<link href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/widgets/modules-widgets.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/authentication/form-1.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/forms/switches.css') }}" rel="stylesheet" type="text/css" >
@stack('styles')
@livewireStyles
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

<style>
    .layout-px-spacing {
        min-height: calc(100vh - 166px)!important;
    }
</style>

<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
