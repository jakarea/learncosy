<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LearnCosy Authintication | Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Admin Template For Filter Developers" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="theme-color" content="#fafafa">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('latest/assets/images/favicon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- all css start -->
    <!-- App css -->
    <link href="http://app.localhost/latest/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('latest/assets/auth-css/custom-login-2.css')}}" rel="stylesheet" type="text/css" />

</head>

<body class="bg-white">

    <header class="login-header">
        <div class="container">
            <div class="logo">
                <a href="{{url('/')}}">
                    <img src="{{ asset('latest/assets/images/logo.svg') }}" alt="logo" title="learncosy logo">
                </a>
            </div>
        </div>
    </header>

    <section class="login-page-wrapper login-four-page-wrap" style="background-image: url({{asset('latest/assets/images/login-left.svg')}});">
        <div class="container">
            <div class="row justify-content-end"> 
                <div class="col-md-6">
                    <div class="login-box-wrap">
                        <div class="login-heading">
                            <h6>Welcome to <span>Learn Cosy</span></h6>
                            <div>
                                <p>No Account ?</p>
                                <a href="#">Sign up</a>
                            </div>
                        </div>
                        <h1>Sign in</h1> 

                        <form action="" class="login-from">
                            <div class="form-group">
                                <label>Enter your username or email address</label>
                                <input type="text" name="email" placeholder="Username or email address"
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Enter your Password</label>
                                <input type="text" name="email" placeholder="Password" class="form-control">
                            </div>
                            <div class="checbox-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Remember for 30 days
                                    </label>
                                </div>
                                <a href="#">Forgot password</a>
                            </div>
                            <div class="submit-button">
                                <button class="btn btn-submit" type="submit">Next</button>
                            </div>
                        </form>

                        <h6 class="or">or</h6>

                        <div class="buttons-group">
                            <a href="#"><img src="{{ asset('latest/assets/images/google.svg') }}" alt="google"
                                    class="img-fluid"> Sign in with Google</a>
                            <a href="#"><img src="{{ asset('latest/assets/images/facebook.svg') }}" alt="google"
                                    class="img-fluid"></a>
                            <a href="#"><img src="{{ asset('latest/assets/images/apple.svg') }}" alt="google"
                                    class="img-fluid"></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>