<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('bundle/course') }}" class="{{ Request::is('bundle/course')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Bundle Courses </a>
    </li>
    <li>
        <a href="{{ url('bundle/course/create') }}" class="{{ Request::is('bundle/course/create')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/Star.svg') }}" alt="Dash" class="img-fluid me-2"> Create </a>
    </li> 
</ul>