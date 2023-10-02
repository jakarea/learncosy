<header class="header-section">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-6 col-md-6 col-lg-6 px-0">
          <div class="header-left-part">
            {{-- header logo --}}
            <div class="header-logo-wrap">
                <a href="{{url('/')}}">
                    <img src="{{ asset('latest/assets/images/logo-d.svg') }}" alt="Logo" title="Learncosy" class="img-fluid" style="width: 11rem"> 
                </a> 
            </div> 
             {{-- header logo --}}
          </div>
        </div>
        <div class="col-6 col-md-6 col-lg-6 px-0">
            <div class="header-start-menu-wrapper justify-content-end">
              <!-- header navbar @S -->
              <div class="header-navbar-wrap">
                  <ul class="head-navbar justify-content-end"> 
                    @if (Route::has('login'))
                      <li class="link-item me-3 me-md-0">
                          <a href="{{ url('/login') }}" class="link-click">Login</a>
                      </li>
                      @endif
                      @if (Route::has('register'))
                      <li class="link-item">
                          <a href="{{ url('/register') }}" class="link-click">Register</a>
                      </li>
                      @endif 
                  </ul>
              </div>
              <!-- header navbar @E -->
  
              <!-- header right icon @S -->
              <div class="header-right-icon-wrap d-none d-sm-block">
                  <ul class="icon-nav">
                      {{-- <li>
                          <div class="dark-mode-bttn">
                              <i class="fa-solid fa-moon"></i>
                              <span>Dark</span>
                          </div>
                      </li>  --}}
                  </ul>
              </div>
              <!-- header right icon @E -->
            </div>
        </div>
      </div>
    </div>
  </header>