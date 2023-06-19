<header class="header-part">
    <div class="row align-items-center">
      <div class="col-lg-5 col-md-12">
        <div class="header-title">
          <a href="#" id="menu-toggle" class="d-none d-lg-block"><i class="fas fa-bars"></i></a> 
          <h3>@yield('title')</h3>
          <div class="user-avatar d-lg-none"> 
            <a href="#" class="avatar"><img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid"></a>
            <a href="#" id="mobile-menu-toggle"><i class="fas fa-bars"></i></a> 
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="header-icons d-none d-lg-block">
          <ul>
            <li>
              <a href="#">
                <span>16</span>
                <i class="fas fa-bell"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <span style="background: #D0412E;">27</span>
                <i class="fas fa-envelope"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <span>83</span>
                <i class="fas fa-calendar"></i>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fas fa-cog"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="user-profile d-none d-lg-flex">
          <div class="media">
            <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
            <div class="media-body">
              <h6>Itadori Yuuji</h6>
              <p>yuujikun@mail.com</p>
            </div>
          </div>
          <div class="language-box">
            <select name="" id="">
              <option value="">EN</option>
              <option value="">BN</option>
              <option value="">HN</option>
            </select>
            <i class="fas fa-caret-down"></i>
          </div>
        </div>
      </div>
    </div>
  </header>