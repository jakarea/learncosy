@extends('layouts/dashboard')
@section('title')Dashboard @endsection

{{-- page style @S --}}
@section('style')
<link rel="stylesheet" href="{{asset('dashboard-assets/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('dashboard-assets/css/dashboard.css')}}">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('contents')
<!-- dashboard page wrapper @s -->
<section class="common-page-wrap dashboard-page-wrap">
    <!-- dashboard chart box @s -->
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-6">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-6">
            <!-- total client @s -->
            <div class="card-box total-client-box">
              <div class="media">
                <div class="media-body">
                  <h5>Total Clients</h5>
                  <h4>68 <span><i class="fas fa-caret-up"></i> +0,5%</span></h4>
                </div>
                <img src="{{asset('dashboard-assets/images/chart-1.svg')}}" alt="Chart" class="img-fluid">
              </div>
            </div>
            <!-- total client @e -->
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-6">
            <!-- total task @s -->
            <div class="card-box total-task-box">
              <div class="media">
                <div class="media-body">
                  <h5>Total Task Done</h5>
                  <div class="d_flex">
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="40"
                      aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar" style="width: 40%"></div>
                    </div>
                    <h4>24</h4>
                  </div>
                  <p><span class="clor-red">76</span> left from target</p>
                </div>
              </div>
            </div>
            <!-- total task @e -->
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-6">
            <!-- total clients @s -->
            <div class="card-box total-client-month">
              <div class="media">
                <div class="media-body">
                  <h4>562</h4>
                  <h5>Total Clients</h5>
                  <p><span class="clor-red">-2% </span> than last month</p>
                </div>
                <div id="clients"></div>
              </div>
            </div>
            <!-- total clients @e -->
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-6">
            <!-- total projects @s -->
            <div class="card-box total-client-month">
              <div class="media">
                <div class="media-body">
                  <h4>892</h4>
                  <h5>New Projects</h5>
                  <p><span>+0,5% </span> than last month</p>
                </div>
                <div id="projects"></div>
              </div>
            </div>
            <!-- total projects @e -->
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <!-- project statistic @s -->
            <div class="card-box project-statistic-wrap">
              <div class="statics-head">
                <h5>Project Statistics</h5>
                <a href="#"><i class="fas fa-bars"></i></a>
              </div>
              <div id="chart"></div>
            </div>
            <!-- project statistic @e -->
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-6">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-6">
            <!-- current balance box @s -->
            <div class="card-box current-balance-box">
              <div class="media">
                <div class="media-body">
                  <p>Current Balance</p>
                  <h5>$ 392,556.76</h5>
                  <p><span>+2.7%</span> than last week</p>
                </div>
                <img src="{{asset('dashboard-assets/images/arrow-up.svg')}}" alt="arrow" class="img-fluid">
              </div>
              <!-- <div id="boxChart"></div> -->
              <div class="mt-4">
                <img src="{{asset('dashboard-assets/images/graph-2.svg')}}" alt="Graph" class="img-fluid">
              </div>
            </div>
            <!-- current balance box @e -->
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-xxl-6">
            <!-- on progress box @s -->
            <div class="card-box on-progress-box">
             <!-- chart-slider @s -->
             <div class="chart-slider">
              <div class="slider-item">
                <div class="mb-2">
                  <img src="{{asset('dashboard-assets/images/graph-3.svg')}}" alt="Graph" class="img-fluid">
                </div>
                <h5>Codebytes Landing Page Websites Projects</h5>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                  totam rem</p>
              </div>
              <div class="slider-item">
                <div class="mb-2">
                  <img src="{{asset('dashboard-assets/images/graph-3.svg')}}" alt="Graph" class="img-fluid">
                </div>
                <h5>Codebytes Landing Page Websites Projects</h5>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                  totam rem</p>
              </div>
             </div>
             <!-- chart-slider @e -->

              <div class="arrows">
                <a href="#" class="prev"><i class="fas fa-arrow-left"></i></a>
                <a href="#" class="next"><i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
            <!-- on progress box @e -->
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12 col-lg-12">
            <!-- try now box @s -->
            <div class="try-now-box">
              <div class="media">
                <div class="media-body">
                  <h5>Manage your project <br>
                    in one touch</h5>

                  <p>Let Fillow manage your project automatically with our best AI systems </p>
                </div>
                <a href="#">Try Free Now</a>
              </div>
            </div>
            <!-- try now box @e -->
          </div>
        </div>
      </div>
    </div>
    <!-- dashboard chart box @e -->

    <!-- dashboard projects and messages box @s -->
    <div class="row">
      <div class="col-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6">
        <div class="card-box important-projects-box">
          <!-- header @s -->
          <div class="media headers">
            <div class="media-body">
              <h5>Important Projects</h5>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
          </div>
          <!-- header @e -->

          <!-- banner project @s -->
          <div class="banner-projects-box">
            <div class="row">
              <div class="col-lg-7 col-12 col-sm-6">
                <div class="media">
                  <img src="{{asset('dashboard-assets/images/company-logo/k-logo.svg')}}" alt="Logo" class="img-fluid">
                  <div class="media-body">
                    <h5>Kleon Studios</h5>
                    <p>Creative Agency</p>
                  </div>
                </div>
                <h4>Landing Page Kleon Websites Development</h4>
                <h6>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                  laudantium...</h6>
                <div class="bottom-box">
                  <span class="tag-bttn">WEBSITES</span>
                  <ul>
                    <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="Small Avatar" class="img-fluid"></li>
                    <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="Small Avatar" class="img-fluid"></li> 
                    <li><img src="{{asset('dashboard-assets/images/small-avatar.svg')}}" alt="Small Avatar" class="img-fluid"></li> 
                    <li><span>2+</span></li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-5 col-12 col-sm-6">
                <div class="project-progress-box">
                  <div class="percent">
                    <svg>
                      <circle cx="115" cy="110" r="100"></circle>
                      <circle cx="115" cy="110" r="100" style="--percent: 40"></circle>
                    </svg>
                    <div class="number">
                      <h3>12</h3>
                      <p>Task Done</p>
                    </div>
                  </div>
                  <div class="text-center">
                    <h6>Due date: 12/05/2020</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- banner project @e -->

          <!-- all projects @s -->
          <div class="all-projects-wrap">
            <!-- project item @s -->
            <div class="project-box brdr-top">
              <div class="media">
                <img src="{{asset('dashboard-assets/images/company-logo/fillow.svg')}}" alt="Logo" class="img-fluid">
                <div class="media-body">
                  <h5>Fillow Team</h5>
                  <p>Creative Agency</p>
                </div>
              </div> 
              <h4>Dashboard for Content Management Systems</h4>
              <div class="bottom-box">
                <span class="tag-bttn mobile">MOBILE</span>
                <span class="tag-bttn">CMS</span>
              </div>
              <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 25%"></div>
              </div>
              <div class="project-ftr">
                <h6><span>12</span> Task Done</h6>
                <p>Due date: 12/05/2020</p>
              </div>
            </div>
            <!-- project item @e -->
            <!-- project item @s -->
            <div class="project-box brdr-left brdr-top">
              <div class="media">
                <img src="{{asset('dashboard-assets/images/company-logo/c-logo.svg')}}" alt="Logo" class="img-fluid">
                <div class="media-body">
                  <h5>Codebyte Base</h5>
                  <p>Marketing Agency</p>
                </div>
              </div> 
              <h4>Optimization Dashboard Page for indexing in Google</h4>
              <div class="bottom-box">
                <span class="tag-bttn seo">SEO</span>
                <span class="tag-bttn marketing">MARKETING</span>
              </div>
              <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 25%"></div>
              </div>
              <div class="project-ftr">
                <h6><span>12</span> Task Done</h6>
                <p>Due date: 12/05/2020</p>
              </div>
            </div>
            <!-- project item @e -->
            <!-- project item @s -->
            <div class="project-box brdr-top">
              <div class="media">
                <img src="{{asset('dashboard-assets/images/company-logo/cafe.svg')}}" alt="Logo" class="img-fluid">
                <div class="media-body">
                  <h5>Ombe Cafe</h5>
                  <p>Cafe</p>
                </div>
              </div> 
              <h4>Responsive Landing Page Website Projects</h4>
              <div class="bottom-box">
                <span class="tag-bttn marketing">MOBILE</span>
                <span class="tag-bttn">WEBSITES</span>
              </div>
              <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 25%"></div>
              </div>
              <div class="project-ftr">
                <h6><span>12</span> Task Done</h6>
                <p>Due date: 12/05/2020</p>
              </div>
            </div>
            <!-- project item @e -->
            <!-- project item @s -->
            <div class="project-box brdr-left brdr-top">
              <div class="media">
                <img src="{{asset('dashboard-assets/images/company-logo/fillow.svg')}}" alt="Logo" class="img-fluid">
                <div class="media-body">
                  <h5>Biji's Coffee</h5>
                  <p>Coffe Shops</p>
                </div>
              </div> 
              <h4>Reservation Application Integrated with Desktop App</h4>
              <div class="bottom-box">
                <span class="tag-bttn marketing">DESKTOP APP</span> 
              </div>
              <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 25%"></div>
              </div>
              <div class="project-ftr">
                <h6><span>12</span> Task Done</h6>
                <p>Due date: 12/05/2020</p>
              </div>
            </div>
            <!-- project item @e -->
          </div>
          <!-- all projects @e -->
        </div>
      </div>
      <div class="col-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-6">
        <!-- message box @s -->
        <div class="card-box message-main-box">
          <!-- header @s -->
          <div class="media headers">
            <div class="media-body">
              <h5>Messages</h5>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <a href="#" class="common-bttn">+New Messages</a>
          </div>
          <!-- header @e -->

          <!-- messages list box @s -->
          <div class="messages-items-wrap">
            <!-- item @s -->
            <div class="messages-item">
              <div class="media">
                <div class="avatar">
                  <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                  <i class="fas fa-circle"></i>
                </div> 
                <div class="media-body">
                  <h5>Maren Rosser <i class="fa-solid fa-check-double"></i></h5>
                  <p>Hei, dont forget to clear server cache!</p>
                </div>
              </div>
              <h6>25min ago</h6>
              <div class="action">
                <a href="#">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>
              </div>
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="messages-item">
              <div class="media">
                <div class="avatar">
                  <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid"> 
                </div> 
                <div class="media-body">
                  <h5>Maren Rosser </h5>
                  <p>Hei, dont forget to clear server cache!</p>
                </div>
              </div>
              <h6>25min ago</h6>
              <div class="action">
                <a href="#">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>
              </div>
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="messages-item">
              <div class="media">
                <div class="avatar">
                  <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid"> 
                </div> 
                <div class="media-body">
                  <h5>Maren Rosser <i class="fa-solid fa-check-double text-secondary"></i></h5>
                  <p>Hei, dont forget to clear server cache!</p>
                </div>
              </div>
              <h6>25min ago</h6>
              <div class="action">
                <a href="#">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>
              </div>
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="messages-item">
              <div class="media">
                <div class="avatar">
                  <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                  <i class="fas fa-circle"></i>
                </div> 
                <div class="media-body">
                  <h5>Maren Rosser <i class="fa-solid fa-check-double"></i></h5>
                  <p>Hei, dont forget to clear server cache!</p>
                </div>
              </div>
              <h6>25min ago</h6>
              <div class="action">
                <a href="#">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>
              </div>
            </div>
            <!-- item @e -->
            <!-- item @s -->
            <div class="messages-item">
              <div class="media">
                <div class="avatar">
                  <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid"> 
                </div> 
                <div class="media-body">
                  <h5>Maren Rosser </h5>
                  <p>Hei, dont forget to clear server cache!</p>
                </div>
              </div>
              <h6>25min ago</h6>
              <div class="action">
                <a href="#">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>
              </div>
            </div>
            <!-- item @e --> 
          </div>
          <!-- messages list box @e -->
        </div>
        <!-- message box @e -->
        <!-- project categories @s -->
        <div class="card-box project-categories-box">
          <!-- header @s -->
          <div class="media headers">
            <div class="media-body">
              <h5>Project Categories</h5>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <a href="#"><i class="fa-solid fa-ellipsis-vertical"></i></a>
          </div>
          <!-- header @e -->

          <!-- categories graph @s -->
          <div class="row">
            <div class="col-lg-12">
              <div class="categories-graph-box">
                <div id="categories"></div>
                <!-- <img src="./assets/images/graph-4.svg" alt="Graph" class="img-fluid"> -->
                <a href="#">Update Progress</a>
              </div>
            </div>
            <!-- <div class="col-lg-6">
              <div class="categories-legend">
                <h5>Legend</h5>

                <ul>
                  <li>
                    <p><span class="box web"></span> Web (27%)</p>
                    <h6>763</h6>
                  </li>
                  <li>
                    <p><span class="box mobile"></span> Mobile (11%)</p>
                    <h6>321</h6>
                  </li>
                  <li>
                    <p><span class="box design"></span>Design (22%)</p>
                    <h6>69</h6>
                  </li>
                  <li>
                    <p><span class="box consulation"></span> Consultation (15%) </p>
                    <h6>154</h6>
                  </li>
                  <li>
                    <p><span class="box others"></span> Others (25%)  </p>
                    <h6>696</h6>
                  </li> 
                </ul>
              </div>
            </div> -->
          </div>
          <!-- categories graph @e -->
        </div>
        <!-- project categories @e -->
      </div>
    </div>
    <!-- dashboard projects and messages box @e -->
  </section>
  <!-- dashboard page wrapper @e -->
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script') 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{asset('dashboard-assets/js/clients-projects-chart.js')}}"></script>
<script src="{{asset('dashboard-assets/js/multiple-chart.js')}}"></script>
<script src="{{asset('dashboard-assets/js/donut-chart.js')}}"></script>
<script src="{{asset('dashboard-assets/js/box-chart.js')}}"></script>
<script src="{{asset('dashboard-assets/js/slick.min.js')}}"></script>
<script src="{{asset('dashboard-assets/js/config.js')}}"></script>
@endsection
{{-- page script @E --}}