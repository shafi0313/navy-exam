<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login | BN Question Bank</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('uploads/images/icons/navy_fav.png') }}" type="image/x-icon" />

    {{-- <!-- Fonts and icons --> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&display=swap" rel="stylesheet">

    {{-- <!-- CSS Files --> --}}
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/azzara.min.css') }}">
</head>

<body>
    <div class="row no-gutters">
        <div class="col-md-8"
            style="background: url('{{ asset('uploads/images/54567.jpg') }}');background-size: cover;background-repeat: no-repeat;">
        </div>
        <div class="col-md-4">
            <div class="login">
                <div class="wrapper wrapper-login">
                    <div class="container container-login animated fadeIn">
                        <h2 class="text-center"
                            style="font-family: 'Marcellus SC', serif; font-weight: bold; font-size: 23px;">Bangladesh
                            Navy Question Bank</h2>
                        <h3 class="text-center">Login</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="alert alert-{{ session('type') }}">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('loginProcess') }}">
                            @csrf
                            <div class="login-form">
                                <div class="form-group">
                                    <label for="username" class="placeholder"><b>Email</b></label>
                                    <input class="form-control" id="email" type="email" name="email" required
                                        autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="placeholder"><b>Password</b></label>
                                    <a href="{{ route('forgetPassword') }}" class="link float-right">Forget Password
                                        ?</a>
                                    <div class="position-relative">
                                        <input class="form-control" id="password" type="password" name="password"
                                            required autocomplete="current-password">
                                        {{-- <div class="show-password">
                                            <i class="flaticon-interface"></i>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="form-group form-action-d-flex mb-3">
                                    {{-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                        <label class="custom-control-label m-0" for="rememberme">Remember Me</label>
                                    </div> --}}
                                    <button type="submit"
                                        class="btn btn-primary col-md-5 m-auto mt-3 mt-sm-0 fw-bold">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('backend/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('backend/js/ready.js') }}"></script>

</html>
