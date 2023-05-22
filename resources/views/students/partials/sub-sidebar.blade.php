<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('instructor/students') }}" class="{{ Request::is('instructor/students')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Students </a>
    </li>
    <li>
        <a href="{{ url('instructor/students/create') }}" class="{{ Request::is('instructor/students/create')  ? ' active' : '' }}">
            <i class="fa-regular fa-pen-to-square me-2"></i> Add </a>
    </li>
</ul>