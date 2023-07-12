{{-- get start @s --}}
<section class="get-start" style="background: {{ modulesetting('primary_color') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="get-start-box">
                    <h5> {!! modulesetting('footer_promote_text') ?? 'Get the best Instructor and best course<br> over the world!' !!} </h5>
                    @if ( Auth::check() )
                        @can('student')
                            <a href="{{ route('students.dashboard') }}"  style="color: {{ modulesetting('secondary_color') }}">{{ modulesetting('footer_promote_btn_text') ?? 'Get enroll now!' }}</a>
                        @else
                            <a href="{{ route('instructor.dashboard.index') }}"  style="color: {{ modulesetting('secondary_color') }}">{{ modulesetting('footer_promote_btn_text') ?? 'Get enroll now!' }}</a>
                        @endcan
                    @else
                        <a href="{{ route('tlogin') }}"  style="color: {{ modulesetting('secondary_color') }}">{{ modulesetting('footer_promote_btn_text') ?? 'Get enroll now!' }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
{{-- get start @e --}}