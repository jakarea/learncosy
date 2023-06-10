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
            <div class="container-fluid ">
                <div class="row d-flex">
                <div class="col align-middle">
                    <div class="px-2 py-2">
                        <img src="https://img.freepik.com/free-vector/happy-freelancer-with-computer-home-young-man-sitting-armchair-using-laptop-chatting-online-smiling-vector-illustration-distance-work-online-learning-freelance_74855-8401.jpg?w=900&t=st=1667037491~exp=1667038091~hmac=7c71ea8afc8f3cc8065c5ccc05d105e3c8a7b76f0133016cb210a7882dc19611" class="img-fluid" alt="...">
                    </div>
                </div>
                <div class="col">
                    <div class="px-5 py-5 mt-5">
                        <div class="px-2 py-2 align-middle">
                            <h4>Get all your needs Here</h4>
                            <p> An online learning and teaching marketplace with over 204000 courses and 54 million students. Learn programming, marketing, data science and more.</p>
                        </div>
                        <div class="px-2 py-2">
                            <button type="button" class="btn btn-outline-primary">Checkout Our Courses</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- main container -->
            <div class="main-container">
                <div class="container-fluid">
                ...
                </div>
            </div>
            <!--  Card container  -->
            <div class="card-container bg-black" id="team">
                <div class="container-fluid px-3 py-3">
                <div class="row center mx-4 my-4 text-white">
                    <h2>Meet Our Expert</h2>
                    <p>Highly professional team</p>
                </div>
                <div class="row mb-5">
                    @foreach($instructors as $instructor)
                    <div class="col-4">
                        <div class="card" >
                            <img src="https://img.freepik.com/free-vector/work-time-concept-illustration_114360-1474.jpg?w=740&t=st=1667038053~exp=1667038653~hmac=7f51a4d7c9f7dc9e0e3a6d53d45f381fc455e5424bcc36a0bedca65db24487e7" class="card-img-top" style="height:300px" alt="...">
                            <div class="card-body">
                            <h5 class="card-title">{{$instructor->name}}</h5>
                            <p class="card-text">Highly proficient in Web3 and AI and professional in Designing Websites with tools of Web3.0.</p>
                            <a href="{{ route('home.instructor.course', $instructor->id) }}" class="btn btn-primary btn-sm btn-block">View Course</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div>
            </div>
            <!-- <div class="aside-container">
                <div class="container-fluid">
                <aside>
                <p>The Epcot center is a theme park at Walt Disney World Resort featuring exciting attractions, international pavilions, award-winning fireworks and seasonal special events.</p>
                </aside>
                </div>
                </div> -->
            <!--  testimonals container  -->
            <div class="testimonals-container mt-4 mb-4" id="testi">
                <div class="container-fluid">
                <div class="row center mx-4 my-4">
                    <h2>What Peoples Say </h2>
                    <p>Read our Testimonals</p>
                </div>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <!--       <img src="..." class="d-block w-100" alt="..."> -->
                            <div class="card-group">
                            <div class="card">
                                <img src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1667039591~exp=1667040191~hmac=3996cb3fe0c2a92d83dfa4986a6da0e62212cabb97397aab04c8f50f771b7f90" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            <div class="card">
                                <img src="https://img.freepik.com/free-vector/mysterious-mafia-man-wearing-hat_52683-34829.jpg?w=740&t=st=1667039801~exp=1667040401~hmac=6b629c58ba7d8377cd74454b010b48bc920e6cb96e6fc6f3733135b8f180519f" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            <div class="card">
                                <img src="https://img.freepik.com/free-vector/mysterious-mafia-man-smoking-cigarette_52683-34828.jpg?w=740&t=st=1667039664~exp=1667040264~hmac=ad7a2beb239191b6f7cf1cb1d1e5f0012768ad0be36cc1b0ad2c461274601ff0" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <!--       <img src="..." class="d-block w-100" alt="..."> -->
                            <div class="card-group">
                            <div class="card">
                                <img src="https://img.freepik.com/free-vector/mysterious-mafia-man-wearing-hat_52683-34829.jpg?w=740&t=st=1667039801~exp=1667040401~hmac=6b629c58ba7d8377cd74454b010b48bc920e6cb96e6fc6f3733135b8f180519f" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            <div class="card">
                                <img src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1667039591~exp=1667040191~hmac=3996cb3fe0c2a92d83dfa4986a6da0e62212cabb97397aab04c8f50f771b7f90" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            <div class="card">
                                <img src="https://img.freepik.com/free-vector/mysterious-mafia-man-smoking-cigarette_52683-34828.jpg?w=740&t=st=1667039664~exp=1667040264~hmac=ad7a2beb239191b6f7cf1cb1d1e5f0012768ad0be36cc1b0ad2c461274601ff0" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <!--       <img src="..." class="d-block w-100" alt="..."> -->
                            <div class="card-group">
                            <div class="card">
                                <img src="https://img.freepik.com/free-vector/mysterious-mafia-man-wearing-hat_52683-34829.jpg?w=740&t=st=1667039801~exp=1667040401~hmac=6b629c58ba7d8377cd74454b010b48bc920e6cb96e6fc6f3733135b8f180519f" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            <div class="card">
                                <img src="https://img.freepik.com/free-vector/mysterious-mafia-man-smoking-cigarette_52683-34828.jpg?w=740&t=st=1667039664~exp=1667040264~hmac=ad7a2beb239191b6f7cf1cb1d1e5f0012768ad0be36cc1b0ad2c461274601ff0" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            <div class="card">
                                <img src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1667039591~exp=1667040191~hmac=3996cb3fe0c2a92d83dfa4986a6da0e62212cabb97397aab04c8f50f771b7f90" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                    </button>
                </div>
                </div>
            </div>
            <!-- overlay box -->
            <!--   <div class="mt-5 mx-1">
                <div class="card bg-black text-white ">
                <div class="card-body px-4 py-4">
                
                </div>
                </div>
                </div> -->
            <!--  banner container  -->
            <div class="banner-container mt-5 mb-5" id="featured">
                <div class="container-fluid px-4 py-4">
                <div class="card bg-black text-white shadow-lg ">
                    <h5 class="card-header">Featured Courses</h5>
                    <div class="card-body">
                        <!--     <h5 class="card-title">Special Teachers for Students</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn org-btn center">Learn More</a> -->
                        <div class="conatiner">
                            <div class="row d-flex justify-content-around">
                            <div class="col">
                                <div class="card text-black move-up mb-3" >
                                    <div class="card-header">Web Development</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Front End + Backend</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <!--     <a href="#" class="btn btn-outline-primary center">View our curriculum</a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-black move-up mb-3" >
                                    <div class="card-header">Web3.0</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Web3 and Tools</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-black move-up mb-3" >
                                    <div class="card-header">Java Masterclass</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Begineer Course</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-black move-up mb-3" >
                                    <div class="card-header">Python </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Python AI</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
       </div>
        <!-- footer -->
        <div class="footer-container foot">
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