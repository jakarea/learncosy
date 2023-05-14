<header class="header-section">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-12 col-md-12 col-lg-6 px-0">
          <div class="header-left-part">
            {{-- header logo @S --}}
            <div class="header-logo-wrap">
                <a href="{{url('/')}}">
                    <img src="{{ asset('assets/images/site-main-logo.png') }}" alt="Logo" title="Giopio" class="img-fluid" /> 
                </a>
                <div class="d-flex align-items-center">
                    <a href="javascript:void(0)" id="toggle-bar">
                        <img src="{{ asset('assets/images/bars-icon.svg') }}" alt="Bars" class="img-fluid" />
                    </a> 
                </div>
            </div>
            {{--  header logo @E --}}
  
            {{-- header search @S --}}
            <div class="header-search-wrap">
                <img src="{{ asset('assets/images/search-icon.svg') }}" alt="Search Icon" class="img-fluid" />
                <input type="text" placeholder="Search" />
            </div>
            {{-- header search @E --}}
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-6 px-0">
            <div class="header-start-menu-wrapper">
              {{-- header navbar @S --}}
              <div class="header-navbar-wrap">
                  <ul class="head-navbar"> 
                      <li class="link-item">
                          <a href="{{ url('/') }}" class="link-click">Dashboard</a>
                      </li>
                      <li class="link-item">
                          <a href="{{ url('/course') }}" class="link-click">Course</a>
                      </li>
                      <li class="link-item">
                          <a href="{{ url('/instructors') }}" class="link-click">Instructor</a>
                      </li>
                  </ul>
              </div>
              {{-- header navbar @E --}}
  
              {{-- header right menu @S --}}
              <div class="header-right-icon-wrap d-none d-sm-block">
                  <ul class="icon-nav">
                      <li>
                          <div class="dark-mode-bttn">
                              <i class="fa-solid fa-moon"></i>
                              <span>Dark</span>
                          </div>
                      </li>
                      <li class="dropdown">
                          <a href="#"data-bs-toggle="dropdown" aria-expanded="false">
                              <img src="{{ asset('assets/images/settings-icon.svg') }}" alt="Settings Icon" class="img-fluid" />
                          </a>  
                          <ul class="dropdown-menu settings-dropdown">   
                              <li><a href="{{url('instructors/profile/nayan-akram')}}"><i class="fas fa-user"></i> My Profile</a></li>  
                             <li><a href="{{ url('/') }}"><i class="fas fa-gear"></i> Settings</a></li> 
                             <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-gear"></i>  Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li> 

                          </ul> 
                      </li>
                  </ul>
              </div>
              {{--  header right menu @E --}}
            </div>
        </div>
      </div>
    </div>
  </header>