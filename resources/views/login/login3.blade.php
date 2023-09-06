<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LearnCosy Authintication | Login Page
    </title>
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
    <link href="{{url('latest/assets/auth-css/custom-login.css')}}" rel="stylesheet" type="text/css" />
    <!-- all css end -->

</head>

<body>
    <header class="login-header">
        <div class="container">
            <div class="logo">
                <a href="{{url('/')}}">
                    <img src="{{ asset('latest/assets/images/logo.svg') }}" alt="logo" title="learncosy logo">
                </a>
            </div>
        </div>
    </header>

    <section class="login-page-wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="left-side-form">
                        <form>
                            <div class="login3form">
                                <h1>Welcome back</h1>
                                <p>Welcome back! Please enter your details.</p>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email </label>
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="••••••••">
                                </div>

                                <div class="form-footer-text d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Remember for 30 days
                                        </label>
                                    </div>
                                    <a href="#" class="forgot-password">Forgot password</a>
                                </div>

                                <div class="submit-button">
                                    <button class="btn btn-submit"
                                        type="submit">Next</button>
                                </div>

                                <p class="register">Don't have an account? <a href="#">Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-side-image">
                        <img src="{{ asset('latest/assets/images/login-3-image.png')}}" alt="login page sidebar image"
                            class="login3image">
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>