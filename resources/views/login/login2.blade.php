
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
    <link rel="shortcut icon" href="http://app.localhost/assets/images/fav.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- all css start --> 
    <!-- App css -->
    <link href="http://app.localhost/latest/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <link href="http://app.localhost/latest/assets/auth-css/header.css?v=1692594964" rel="stylesheet" type="text/css" />
    <!-- all css end -->
<style>

    @import url('https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@400;600&display=swap');
    * {
        padding: 0;
        margin: 0;
        outline: none;
        list-style-type: none;
        text-decoration: none;
        box-sizing: border-box;
        }

        ol,
        ul,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        a,
        p,
        i,
        button,
        strong,
        u,
        sub,
        sup,
        span,
        textarea,
        table tr td,
        select,
        input {
        padding: 0;
        margin: 0;
        }

        select:focus-within,
        textarea:focus-within,
        input:focus-within,
        .form-control:focus-within,
        button:focus-within {
        box-shadow: none !important;
        }

        a,
        a:hover {
        color: #000;
        text-decoration: none;
        }

        ol,
        ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        }
        .container{
            max-width: 1212px!important;
        }
        body{
            min-height: 100vh;
            background: #FF9D25;
        }

        .login-body{
            position: relative;
            z-index: 1;
        }
        .login2-logo {
            padding: 24px 0;
        }
        .login-text{
            margin-top: 70px;
        }
        .login-text h1{
            color: #ffffff;
            font-size: 36px;
            font-weight: 600;
            font-style: normal;
            font-family: 'Poppins', sans-serif;
            line-height: normal;
        }

        .login-text h3{
            font-size: 24px;
            font-family: 'Poppins';
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            line-height: normal;
            font-style: normal;
        }

        .login-text p{
            margin-top: 22px;
            width: 54%;
            font-size: 16px;
            color: #ffffff;
            font-weight: 400;
            line-height: normal;
            font-style: normal;
            font-family: 'Inter';
        }

        .login-promo-image {
            margin-left: -30px;
            margin-top: 180px;
        }

        .form-login{
            padding: 44px;
            border-radius: 40px;
            background: #FFF;
            box-shadow: 0px 4px 35px 0px rgba(0, 0, 0, 0.08);
            margin-left: auto;
            max-width:540px;
        }
        .form-login .login-heading p{
            color: #000;
            font-family: Inter;
            font-size: 21px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }
        .form-login h1{
            font-size: 55px;
        }
        .form-login .login-heading span{
            color: #FF9D25
        }
        .form-login .login-heading div p{
            color: #8D8D8D;
            font-family: Inter;
            font-size: 13px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }
        .form-login .login-heading{
            justify-content: space-between;
        }
        .form-login .login-heading div a{
            color: #FF9D25;
        }
        .button-group {
            margin: 51px 0;
            justify-content: space-between;
        }
        button.btn.google {
            padding: 0 70px 0 32px;
        }
        .button-group .btn {
            font-size: 16px;
            color: #FF9D25;
            background: #FFF7E8;
            height: 55px;
            border-radius: 9px;
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            display: flex;
            align-items: center;
        }
        img.btn-google-logo {
            margin-right: 10px;
        }
        
        .login-form lebel {
            color: #000;
            font-family: Inter;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            display: block;
            margin-bottom: 17px;
        }
        input.form-control {
            padding: 19px 0 19px 20px;
            background: #fff;
            border-radius: 9px;
            margin-bottom: 38px
            
        }

        input.form-control:focus {
            border: 1px solid #FF9D25;
            
        }
        .checkbox{
            justify-content: space-between;
        }
        .checkbox p{
            color: #FF9D25;
        }
        .checkbox lebel{
            color: var(--gray-700, #344054);
            font-family: Inter;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 20px; 
        }
        .form-check-input:checked {
            background-color: #FF9D25!important;
            border-color: #FF9D25;
        }
        button.btn.d-block.w-100.text-center {
            background: #FF9D25;
            margin-top: 41px;
            color: #fff;
            padding: 16px 0;
            border-radius: 10px;
            font-size: 16px;
            font-family: 'Poppins';
            font-weight: 500;
        }
        .white-box {
            width: 100%;
            height: 58%;
            background: #fff;
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: -1;
        }
</style>
</head>

<body> 
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a href="{{url('/')}}">
                    <img src="{{ asset('latest/assets/images/login2-logo.svg') }}" alt="Leancosy white logo" title="Leancosy white logo" class="login2-logo" /> 
                </a>
            </div>
        </nav>
        
    </header>
    <section class="login-body">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="login-text">
                        <h1>Sign in to </h1>
                        <h3>Learn Cosy</h3>
                        <p>Whether you're a student, professional, or lifelong learner, our eLearning website empowers you to pursue your passions, achieve your aspirations, and stay ahead in today's dynamic world. Unlock a world of knowledge and growth with us today!</p>
                    </div>
                    <div class="login-promo-image">
                    <img src="{{ asset('latest/assets/images/login2-image.png') }}" alt="Leancosy white logo" title="Leancosy white logo" class="login2-logo" /> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-login">
                        <div class="login-heading d-flex">
                            <p>Welcome to <span>Learn Cosy</span></p>
                            <div>
                                <p>No Account ?</p>
                                <a href="#">Sign up</a>
                            </div>
                        </div>
                        <h1>Sign in</h1>
                        <div class="button-group d-flex" >
                            <button class="btn google"><img src="{{ asset('latest/assets/images/google.svg') }}" alt="google logo" title="google logo" class="btn-google-logo" />  Sign in with Google</button>
                            <button class="btn facebook"><img src="{{ asset('latest/assets/images/facebook.svg') }}" alt="Facebook logo" title="Facebook logo" class="google-logo" /></button>
                            <button class="btn apple"><img src="{{ asset('latest/assets/images/apple.svg') }}" alt="apple logo" title="apple logo" class="login2-logo" /></button>
                        </div>

                        <form action="" class="login-form"> 
                            <div class="form-group">
                                <lebel>Enter your username or email address</lebel>
                                <input type="text" name="email" placeholder="Username or email address" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <lebel>Enter your Password</lebel>
                                <input type="text" name="email" placeholder="password" class="form-control"/>
                            </div>
                            <div class="d-flex checkbox">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Remember for 30 days
                                    </label>
                                </div>
                                <p>Forgot password</p>
                            </div>
                            <div class="submit-button">
                                <button class="btn d-block w-100 text-center" type="submit">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="white-box"></div>
    </secrion>
</body>
</html>