<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('instructor/courses') }}" class="{{ Request::is('instructor/courses')  ? ' active' : '' }}">
            <i class="fa-solid fa-user-graduate me-2"></i> All Courses </a>
    </li>
    <li>
        <a href="{{ url('instructor/courses/create') }}" class="{{ Request::is('instructor/courses/create')  ? ' active' : '' }}">
            <i class="fa-regular fa-pen-to-square me-2"></i> Create </a>
    </li> 
</ul>