<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Social Media') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/left-sidebar.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Template CSS -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Laravel + Livewire -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    {{-- ✅ Sidebar --}}
    @include('components.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            {{-- ✅ Topbar --}}
            @include('components.topbar')

            <!-- Page Content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9">
                        {{ $slot }}
                    </div>
                    <div class="col-lg-3">
                        @livewire('right-sidebar')
                    </div>
                </div>
            </div>

        </div>

        {{-- ✅ Footer --}}
        @include('components.footer')

    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
@livewireScripts

<script>
    function copyLink(link) {
        navigator.clipboard.writeText(link);
        alert('Post link copied!');
    }
</script>

</body>
</html>
