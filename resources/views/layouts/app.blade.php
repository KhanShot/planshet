<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:ital,wght@0,700;0,800;1,700;1,800&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/style.css', 'resources/js/app.js',
        'resources/js/jquery.min.js', 'resources/js/main.js'])

{{--    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>--}}


</head>
<body>
<div class="wrapper d-flex align-items-stretch">
    @include('includes.sidebar')

    <!-- Page Content  -->
    <div class="container-fluid pl-4 mt-5 pt-4 ">
        @yield('content')
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>


<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');
    FilePond.registerPlugin(FilePondPluginFileValidateType);

    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
        acceptedFileTypes: ['video/*'],
    });
</script>

@yield('js')
</body>
</html>
