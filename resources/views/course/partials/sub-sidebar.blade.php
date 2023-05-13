<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('course') }}" class="{{ Request::is('course')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Courses </a>
    </li>
    <li>
        <a href="{{ url('course/create') }}" class="{{ Request::is('course/create')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/Star.svg') }}" alt="Dash" class="img-fluid me-2"> Create </a>
    </li>
    <li>
        <a href="{{ url('course/react-redux') }}" class="{{ Request::is('course/react-redux')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/Star.svg') }}" alt="Dash" class="img-fluid me-2"> Signle </a>
    </li>
</ul>