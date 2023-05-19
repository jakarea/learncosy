<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('instructor/bundle/courses') }}" class="{{ Request::is('instructor/bundle/courses')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Bundle Courses </a>
    </li>
    <li>
        <a href="{{ url('instructor/bundle/courses/create') }}" class="{{ Request::is('instructor/bundle/courses/create')  ? ' active' : '' }}">
            <i class="fa-regular fa-pen-to-square me-2"></i> Create </a>
    </li> 
</ul>