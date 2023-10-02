<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('instructor/bundle/courses') }}" class="{{ Request::is('instructor/bundle/courses')  ? ' active' : '' }}">
            <i class="fa-solid fa-cube me-2"></i> All Bundle Courses </a>
    </li>
    <li>
        <a href="{{ url('instructor/bundle/courses/create') }}" class="{{ Request::is('instructor/bundle/courses/create')  ? ' active' : '' }}">
            <i class="fa-regular fa-pen-to-square me-2"></i> Create </a>
    </li> 
</ul>