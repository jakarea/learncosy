<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('module') }}" class="{{ Request::is('module')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Module </a>
    </li>
    <li>
        <a href="{{ url('module/create') }}" class="{{ Request::is('module/create')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/Star.svg') }}" alt="Dash" class="img-fluid me-2"> Create </a>
    </li> 
</ul>