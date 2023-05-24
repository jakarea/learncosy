<ul class="pages-submenu-wrap e-learn-pages-submenu-wrap "> 
    <li>
        <a href="{{ url('instructor/settings/stripe') }}" class="{{ Request::is('instructor/settings/stripe*')  ? ' active' : '' }}">
            <i class="fa-brands fa-cc-stripe me-2"></i> Stripe </a>
    </li>
    <li>
        <a href="{{ url('instructor/settings/vimeo') }}" class="{{ Request::is('instructor/settings/vimeo*')  ? ' active' : '' }}">
            <i class="fa-brands fa-vimeo me-2"></i> Vimeo </a>
    </li> 
</ul>