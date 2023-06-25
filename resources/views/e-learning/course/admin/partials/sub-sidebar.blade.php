<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('admin/courses') }}" class="{{ Request::is('admin/courses')  ? ' active' : '' }}">
            <i class="fa-solid fa-user-graduate me-2"></i> All Courses </a>
    </li> 
    <li>
        <a href="{{ url('admin/bundle/courses') }}" class="{{ Request::is('admin/bundle/courses*')  ? ' active' : '' }}">
            <i class="fa-solid fa-cubes me-2"></i> All Bundle Courses </a>
    </li> 
    <li>
        <a href="{{ url('admin/modules') }}" class="{{ Request::is('admin/modules')  ? ' active' : '' }}">
            <i class="fa-solid fa-hotel me-3"></i> All Modules </a>
    </li> 
    <li>
        <a href="{{ url('admin/lessons') }}" class="{{ Request::is('admin/lessons')  ? ' active' : '' }}">
            <i class="fa-solid fa-video me-2"></i>All Lessons </a>
    </li> 
</ul>