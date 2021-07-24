<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MobiSocial') }}</title>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    @include(Shopy::adminViewPath('components.css-headers'))

    <script type="text/javascript" src="{{Shopy::adminAsset('js/components.js')}}"></script>

	{{-- <script type="text/javascript" src="{{asset('js/angular.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/admin/main.js')}}"></script> --}}

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};

		window.baseUrl = '{{url('')}}';
    </script>

	<script src="{{Shopy::adminAsset('plugins/tinymce/tinymce.min.js')}}"></script>
	
	<style type="text/css">
		table thead tr th {
			font-weight: bold !important;
			color: #8e24aa !important;
		}
    </style>
    
    @stack('styles')
</head>
<body>
    @yield('content')

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <!--   Core JS Files   -->
	@include(Shopy::adminViewPath('components.core-js'))
    <!-- Modal -->
    
    <!-- modals components -->
    @stack('modals')
    @stack('endbody')
    
    @stack('scripts')
</body>
</html>
