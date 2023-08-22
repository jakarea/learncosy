
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

    @import url('https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@400;600&family=Roboto:wght@500&display=swap');

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

    .media {
        display: flex;
        align-items: flex-start;
    }

    .media-body {
        flex: 1;
    }

    hr {
        border: none;
        display: block;
        width: 100%;
        height: 1px;
    }

    h1,
    h2 {
        font-size: 3.5rem;
        line-height: normal;
    }

    h3,
    h4 {
        font-size: 2.6rem;
        line-height: normal;
    }

    h5,
    h6 {
        font-size: 2rem;
        line-height: normal;
    }

    p {
        font-size: 1rem;
        line-height: normal;
    }

    body {
        background-color: #F9FAFB;
        overflow-x: hidden;
        font-family: "Inter", sans-serif;
    }

    h1.login-heading {
        color: #101828;
        font-family: "Inter", sans-serif;
        font-size: 30px;
        font-style: normal;
        font-weight: 600;
        line-height: 38px; /* 126.667% */
    }
    p.login-text {
        color: #667085;
        font-family: "Inter", sans-serif;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 24px;
    }

    .login3form input {
        color: #66768E;
        font-family: "Inter", sans-serif;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 20px;
    }

    .form-footer-text label{
        color:  #344054;
        font-family: 'Inter';
        font-size: 14px;
        font-style: normal;
        font-weight: 500;
        line-height: 20px;
    }
    a.forgot-password{
        color: #294CFF;
        font-family: Inter;
        font-size: 14px;
        font-style: normal;
        font-weight: 500;
        line-height: 20px;
    }
    button.submit-button {
        background-color: #294CFF;
        color: #FFF;
        font-family: Inter;
        font-size: 16px;
        font-style: normal;
        font-weight: 500;
        line-height: 24px;
    }
    /* .form-footer-text.d-flex {
        justify-content: space-between;
    } */
</style>
</head>
<!-- <img src="{{ asset('latest/assets/images/login2-logo.svg') }}" alt="Leancosy white logo" title="Leancosy white logo" class="login2-logo" />  -->
<body> 
    <header>
        <nav>
            <div class="container">
                <div class="log">
                    <a href="">
                        <img src="{{ asset('latest/assets/images/login2-logo.svg') }}" alt="logo" title="learncosy logo">
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <section class="login-body">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-side-form">
                        <form>
                            <div class="login3form">
                                <h1 class="login-heading">Welcome back</h1>
                                <p class="login-text">Welcome back! Please enter your details.</p>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email </label>
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                </div>

                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="**********">
                                </div>

                                <div class="form-footer-text d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Default checkbox
                                        </label>
                                    </div>
                                    <a href="" class="forgot-password">Forgot password</a>
                                </div>
                                
                                <div class="submit-button">
                                <button class="btn d-block w-100 text-center submit-button" type="submit">Next</button>
                            </div>

                                <p class="register">Don’t have an account?<a href="">Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-side-image">
                        <img src="{{ asset('latest/assets/images/login-3-image.png')}}" alt="login page sidebar image" class="login3image">
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>