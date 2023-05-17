<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('instructor/courses') }}" class="{{ Request::is('instructor/courses')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Courses </a>
    </li>
    <li>
        <a href="{{ url('instructor/courses/create') }}" class="{{ Request::is('instructor/courses/create')  ? ' active' : '' }}">
            <i class="fa-regular fa-pen-to-square me-2"></i> Create </a>
    </li>
    <li>
        <a href="{{ url('instructor/courses/react-redux') }}">
            <img src="{{ asset('assets/images/course/Star.svg') }}" alt="Dash" class="img-fluid me-2"> Signle </a>
    </li>
</ul>