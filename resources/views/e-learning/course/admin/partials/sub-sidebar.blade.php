<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('admin/courses') }}" class="{{ Request::is('admin/courses')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Courses </a>
    </li>
    <li>
        <a href="{{ url('admin/courses/create') }}" class="{{ Request::is('admin/courses/create')  ? ' active' : '' }}">
            <i class="fa-regular fa-pen-to-square me-2"></i> Create </a>
    </li> 
</ul>