<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="/images/ngaoo-logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Module Admin</title>

       {{-- Laravel Mix - CSS File --}}
       <link rel="stylesheet" href="{{ asset('admin_assets/css/admin.css') }}">
       <script>
            window.user = {
                id: {{ auth()->id() }},
                name: "{{ auth()->user()->name }}"
            }
            window.csrfToken = "{{ csrf_token() }}";
        </script>
    </head>
    <body>
        @yield('content')

        {{-- Laravel Mix - JS File --}}
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
