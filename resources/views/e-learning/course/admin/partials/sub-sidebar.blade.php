<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('admin/courses') }}" class="{{ Request::is('admin/courses')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Courses </a>
    </li> 
    <li>
        <a href="{{ url('admin/bundle/courses') }}" class="{{ Request::is('admin/bundle/courses*')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Bundle Courses </a>
    </li> 
    <li>
        <a href="{{ url('admin/modules') }}" class="{{ Request::is('admin/modules')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Modules </a>
    </li> 
    <li>
        <a href="{{ url('admin/lessons') }}" class="{{ Request::is('admin/lessons')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Lessons </a>
    </li> 
</ul>