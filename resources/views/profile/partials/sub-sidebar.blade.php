<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('instructors') }}" class="{{ Request::is('instructors')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/book.svg') }}" alt="Dash" class="img-fluid me-2"> All Instructors </a>
    </li>
    <li>
        <a href="{{ url('instructors/profile/nayan-akram') }}" class="{{ Request::is('instructors/profile*')  ? ' active' : '' }}">
            <img src="{{ asset('assets/images/course/Star.svg') }}" alt="Dash" class="img-fluid me-2"> Profile </a>
    </li> 
</ul>