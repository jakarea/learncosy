<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/4.0.0/iconfont/material-icons.min.css" rel="stylesheet" type="text/css" />
      <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet" type="text/css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <div class="nav-bar">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">LearnCosy</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#hero-sec">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#team">Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#testi">Testimonials</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#featured">Featured</a>
                        </li>
                    </ul>
                </div>
                </div>
            </nav>
         </div>
      </div>
      <div class="container">
        <div class="hero-container" id="hero-sec">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Course BY</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{$instructors->name}}</li>
            </ol>
            </nav>
            <!-- main container -->
            <div class="main-container">
                <div class="container-fluid">
                    <div class="row mb-5">
                        @foreach($courses as $course)
                        <div class="col-4">
                                <div class="card" >
                                    <img src="https://img.freepik.com/free-vector/work-time-concept-illustration_114360-1474.jpg?w=740&t=st=1667038053~exp=1667038653~hmac=7f51a4d7c9f7dc9e0e3a6d53d45f381fc455e5424bcc36a0bedca65db24487e7" class="card-img-top" style="height:300px" alt="...">
                                    <div class="card-body">
                                    <h5 class="card-title">{{$course->title}}</h5>
                                    <p class="card-text">Highly proficient in Web3 and AI and professional in Designing Websites with tools of Web3.0.</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
       </div>
                   <!-- footer -->
                   <div class="footer-container foot bg-dark container-fluid">
                <div class="container-fluid">
                <footer>
                    <div class="">
                        <div class="row">
                            <div class="col-md-4 footer-column">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <span class="footer-title">Product</span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Product 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Product 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Plans & Prices</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Frequently asked questions</a>
                                </li>
                            </ul>
                            </div>
                            <div class="col-md-4 footer-column">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <span class="footer-title">Company</span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">About us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Job postings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">News and articles</a>
                                </li>
                            </ul>
                            </div>
                            <div class="col-md-4 footer-column">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <span class="footer-title">Contact & Support</span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link"><i class="fas fa-phone"></i>+47 45 80 80 80</span>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fas fa-comments"></i>Live chat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fas fa-envelope"></i>Contact us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fas fa-star"></i>Give feedback</a>
                                </li>
                            </ul>
                            </div>
                        </div>
                        <div class="text-center"><i class="fas fa-ellipsis-h"></i></div>
                        <div class="row text-center">
                            <div class="col-md-4 box">
                            <span class="copyright quick-links">
                                Copyright &copy; Your Website <script>document.write(new Date().getFullYear())</script>
                            </span>
                            </div>
                            <div class="col-md-4 box">
                            <ul class="list-inline social-buttons">
                                <li class="list-inline-item">
                                    <a href="#">
                                    <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">
                                    <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                            </div>
                            <div class="col-md-4 box">
                            <ul class="list-inline quick-links">
                                <li class="list-inline-item">
                                    <a href="#">Privacy Policy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#">Terms of Use</a>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.min.js"></script>
                </footer>  
            </div>
   </body>
</html>