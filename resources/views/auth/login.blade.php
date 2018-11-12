<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sebelas</title>
    <meta name="description" content="Sebelas">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-touch-icon-60x60.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">


    <link rel="stylesheet" href="{{ asset('sufee/vendors/bootstrap/dist/css/bootstrap.min.css')  }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/font-awesome/css/font-awesome.min.css')  }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/themify-icons/css/themify-icons.css')  }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/flag-icon-css/css/flag-icon.min.css')  }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/selectFX/css/cs-skin-elastic.css')  }}">

    <link rel="stylesheet" href="{{ asset('sufee/assets/css/style.css')  }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#log-in-page">
                        <img class="align-content" src="{{ asset('favicon/mstile-70x70.png') }}" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
							<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

							@if ($errors->has('email'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
                        </div>
                            <div class="form-group">
                                <label for="password">Password</label>
								<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                                <div class="checkbox">
                                    <label>
									<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> 
									Remember Me
                            </label>
                                    <!--<label class="pull-right">
                                <a href="{{ route('password.request') }}">Forgotten Password?</a>
                            </label>-->

                                </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('sufee/vendors/jquery/dist/jquery.min.js' ) }}"></script>
    <script src="{{ asset('sufee/vendors/popper.js/dist/umd/popper.min.js' ) }}"></script>
    <script src="{{ asset('sufee/vendors/bootstrap/dist/js/bootstrap.min.js' ) }}"></script>
    <script src="{{ asset('sufee/assets/js/main.js' ) }}"></script>


</body>

</html>
