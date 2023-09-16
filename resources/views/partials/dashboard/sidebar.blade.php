<aside class="sidebar-wrapper" id="main-menu">
    <!-- logo box @s -->
    <div class="logo-box">
      <a href="#">
        <!-- main logo @s -->
        <img src="{{asset('dashboard-assets/images/logo.svg')}}" alt="Logo" class="img-fluid main-logo d-none d-lg-block">
        <img src="{{asset('dashboard-assets/images/mobile-logo.svg')}}" alt="Logo" class="img-fluid d-lg-none">
        <!-- main logo @e -->
        <!-- secondary logo @s -->
        <img src="{{asset('dashboard-assets/images/favicon.svg')}}" alt="Logo" class="img-fluid secondary-logo">
        <!-- secondary logo @e -->
      </a>
    </div>
    <!-- logo box @e -->

    <!-- main menu @s -->
    <div class="main-sidebar-menu">
      <h5>Main Menu</h5>
      <ul>
        <li>
          <a href="{{ url('new-dashboard') }}" class="{{ Request::is('new-dashboard')  ? ' active' : '' }}">
            <img src="{{asset('dashboard-assets/images/sidebar-icon/dashboard.svg')}}" alt="Dashboard" class="img-fluid">
            <span class="menu-text">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ url('new-dashboard/projects') }}" class="{{ Request::is('new-dashboard/projects')  ? ' active' : '' }}">
            <img src="{{asset('dashboard-assets/images/sidebar-icon/project.svg')}}" alt="project" class="img-fluid">
            <span class="menu-text">Project</span>
            <span class="box gren">83</span>
            <i class="fas fa-caret-right"></i>
          </a>
        </li>
        <li>
          <a href="{{ url('new-dashboard/contacts') }}" class="{{ Request::is('new-dashboard/contacts')  ? ' active' : '' }}">
            <img src="{{asset('dashboard-assets/images/sidebar-icon/contact.svg')}}" alt="contact" class="img-fluid">
            <span class="menu-text">Contacts</span>
          </a>
        </li>
        <li>
          <a href="{{ url('new-dashboard/kanban') }}" class="{{ Request::is('new-dashboard/kanban')  ? ' active' : '' }}">
            <img src="{{asset('dashboard-assets/images/sidebar-icon/kanban.svg')}}" alt="kanban" class="img-fluid">
            <span class="menu-text">Kanban</span>
            <span class="box prime">16</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="{{asset('dashboard-assets/images/sidebar-icon/graph.svg')}}" alt="graph" class="img-fluid">
            <span class="menu-text">Analytics</span>
          </a>
        </li>
        <li>
          <a href="{{ url('new-dashboard/calendar') }}" class="{{ Request::is('new-dashboard/calendar')  ? ' active' : '' }}">
            <img src="{{asset('dashboard-assets/images/sidebar-icon/calendar.svg')}}" alt="calendar" class="img-fluid">
            <span class="menu-text">Calendar</span>
          </a>
        </li>
        <li>
          <a href="{{ url('new-dashboard/messages') }}" class="{{ Request::is('new-dashboard/messages')  ? ' active' : '' }}">
            <img src="{{asset('dashboard-assets/images/sidebar-icon/message.svg')}}" alt="message" class="img-fluid">
            <span class="menu-text">Messages</span>
          </a>
        </li>
      </ul>
    </div>
    <!-- main menu @e -->

    <!-- learn more box @s -->
    <div class="learn-more-box">
      <h5>How codebytes control your task?</h5>
      <a href="#">Learn more <i class="fas fa-caret-right"></i></a>
    </div>
    <!-- learn more box @e -->

    <!-- sidebar ftr txt @s -->
    <div class="sidebar-ftr-txt">
      <h6>Giopio Saas Admin</h6>
      <p>&copy; 2023 All Rights Reserved</p>
    </div>
    <!-- sidebar ftr txt @e -->
  </aside>