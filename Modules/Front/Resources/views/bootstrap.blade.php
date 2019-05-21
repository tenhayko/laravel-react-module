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
       <link rel="stylesheet" href="{{ asset('css/front.css') }}">
       <script>
            window.csrfToken = "{{ csrf_token() }}";
        </script>
    </head>
    <body>
        <div id="bootstrap"></div>
        {{-- Laravel Mix - JS File --}}
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
