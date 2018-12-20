<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin login</title>
        <link rel="icon" href="/images/download.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/admin-login.css') }}">

    </head>
    <body id="login">
            <img src="data:image/png;base64,{{ chunk_split(base64_encode('blob:http://app.local/defbc5c3-c583-4364-a884-883c73aadb5a')) }}" height="100" width="100">
        <div class="row">
            <div class="col-md-8 h-100vh image-login">
            <!-- logo -->
            <!-- <div class="pos-a centerXY">
                <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px">
                    <img class="pos-a centerXY" src="assets/static/images/logo.png" alt="">
                </div>
            </div> -->
            <!-- end logo -->
            </div>
            <div class="col-md-4 login-form h-100vh" style="min-width:320px">
                <div>
                    <h4 class="fw-300 c-grey-900 mB-40 un-select">Login</h4>
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label class="text-normal text-dark un-select">Username</label>
                            <input type="email" name="email" class="form-control" placeholder="John Doe" value="tenhayko@gmail.com">
                        </div>
                        <div class="form-group">
                            <label class="text-normal text-dark un-select">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" value="123456">
                        </div>
                        <div class="form-group">
                            <div class="peers ai-c jc-sb fxw-nw">
                                <div class="float-left">
                                    <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                                        <input type="checkbox" id="remember" name="remember" class="peer cur-p" checked>
                                        <label for="remember"><span class="peer peer-greed un-select cur-p">Remember Me</span></label>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>
