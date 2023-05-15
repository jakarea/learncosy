<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('course') }}" class="{{ Request::is('course')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Courses </a>
    </li>
    <li>
        <a href="{{ url('course/create') }}" class="{{ Request::is('course/create')  ? ' active' : '' }}">
            <i class="fa-regular fa-pen-to-square me-2"></i> Create </a>
    </li>
    <li>
        <a href="{{ url('course/react-redux') }}" class="{{ Request::is('course/react-redux')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/Star.svg') }}" alt="Dash" class="img-fluid me-2"> Signle </a>
    </li>
</ul>