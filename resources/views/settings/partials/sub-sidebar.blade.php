<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('settings/instructor/stripe') }}" class="{{ Request::is('settings/instructor/stripe*')  ? ' active' : '' }}">
            <i class="fa-brands fa-cc-stripe me-2"></i> Stripe </a>
    </li>
    <li>
        <a href="{{ url('settings/instructor/vimeo') }}" class="{{ Request::is('settings/instructor/vimeo*')  ? ' active' : '' }}">
            <i class="fa-brands fa-vimeo me-2"></i> Vimeo </a>
    </li> 
</ul>