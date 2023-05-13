<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('lesson') }}" class="{{ Request::is('lesson')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Lesson </a>
    </li>
    <li>
        <a href="{{ url('lesson/create') }}" class="{{ Request::is('lesson/create')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/Star.svg') }}" alt="Dash" class="img-fluid me-2"> Create </a>
    </li> 
</ul>