<header class="header-section" style="background: {{ modulesetting('primary_color') }}">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-12 col-md-12 col-lg-6 px-0">
				<div class="header-left-part">
					{{-- header logo @S --}}
					<div class="header-logo-wrap">
						<a href="{{url('/')}}">
                            @if ( modulesetting('logo') )
                            <img src="{{asset('assets/images/setting/'.modulesetting('logo'))}}" alt="home-page-hero" class="img-fluid">
                            @else
                            <img src="{{ asset('assets/images/learncosy-logo.png') }}" alt="Logo" title="Giopio" class="img-fluid logo-width" />
                            @endif 
						</a>
						<div class="d-flex align-items-center">
							<a href="javascript:void(0)" id="toggle-bar">
								<i class="fa-solid fa-bars-staggered text-white"></i>
							</a> 
						</div>
					</div>
					{{--  header logo @E --}}
					{{-- header search @S --}}
					{{-- <div class="header-search-wrap">
						<img src="{{ asset('assets/images/search-icon.svg') }}" alt="Search Icon" class="img-fluid" />
						<input type="text" placeholder="Search" />
					</div> --}}
					{{-- header search @E --}}
				</div>
			</div>
			<div class="col-12 col-md-12 col-lg-6 px-0">
				<div class="header-start-menu-wrapper">
					{{-- header navbar @S --}}
					<div class="header-navbar-wrap">
						<ul class="head-navbar">
							<li class="link-item">
								<a href="{{ url('/') }}" class="link-click">Dashboard</a>
							</li>
						</ul>
					</div>
					{{-- header navbar @E --}}
					{{-- header right menu @S --}}
					<div class="header-right-icon-wrap d-none d-sm-block">
						<ul class="icon-nav">
							{{-- 
							<li>
								<div class="dark-mode-bttn">
									<i class="fa-solid fa-moon"></i>
									<span>Dark</span>
								</div>
							</li>
							--}}
							<li class="dropdown">
								<a href="#"data-bs-toggle="dropdown" aria-expanded="false">
									<i class="fa-solid fa-cog text-white"></i>
								</a>  
								<ul class="dropdown-menu settings-dropdown">
									<li><a href="{{url('/instructor/profile/myprofile')}}"><i class="fas fa-user"></i> My Profile</a></li>
									<li><a href="{{ url('instructor/settings/stripe') }}"><i class="fa-brands fa-cc-stripe me-2"></i> Stripe</a></li>
									<li><a href="{{url('instructor/settings/vimeo')}}"><i class="fa-brands fa-vimeo me-2"></i>Vimeo</a></li>
									<li><a href="{{ url('instructor/payments/platform-fee') }}"><i class="fas fa-euro-sign"></i> Platform Fee</a></li> 
									<li><a href="{{ route('module.setting', auth()->user()->id) }}"><i class="fas fa-cog"></i> Module Setting</a></li>
									<li>
										<a href="{{ route('logout') }}" onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
										<i class="fa-solid fa-arrow-right-from-bracket"></i>
										<span>{{ __('Logout') }}</span>
										</a> 
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					{{--  header right menu @E --}}
				</div>
			</div>
		</div>
	</div>
</header>