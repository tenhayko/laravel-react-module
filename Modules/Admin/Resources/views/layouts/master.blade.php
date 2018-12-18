<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="/images/ngaoo-logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Admin</title>

       {{-- Laravel Mix - CSS File --}}
       <link rel="stylesheet" href="{{ asset('admin_assets/css/admin.css') }}">
    </head>
    <body>
        @yield('content')

        {{-- Laravel Mix - JS File --}}
    </body>
</html>
