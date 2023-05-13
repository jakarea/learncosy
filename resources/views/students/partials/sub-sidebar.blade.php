<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('students') }}" class="{{ Request::is('students')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Students </a>
    </li>
    <li>
        <a href="{{ url('students/create') }}" class="{{ Request::is('students/create')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/Star.svg') }}" alt="Dash" class="img-fluid me-2"> Create </a>
    </li>
    <li>
        <a href="{{ url('students/react-redux') }}" class="{{ Request::is('students/react-redux')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/Star.svg') }}" alt="Dash" class="img-fluid me-2"> Signle </a>
    </li>
</ul>