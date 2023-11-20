@forelse ($users as $user)
    <div class="single-person suggest-people border-0" id="{{ $user->id }}">
        <div class="media p-0 border-0">
            @isset($user)
                <div class="avatar">
                    <img src="{{ asset($user->avatar) }}" alt="Avatar" class="img-fluid me-0">
                    @if(Cache::has('user-is-online-' . $user->id))
                        <i class="fas fa-circle"></i>
                    @else
                        <i class="fa-regular fa-circle"></i>
                    @endif
                </div>
            @else
                <div class="avatar">
                    <img src="{{ asset('latest/assets/images/update-5.png') }}"
                        alt="Avatar" class="img-fluid me-0">
                    <i class="fas fa-circle"></i>
                </div>
            @endisset

            <div class="media-body">
                <div class="name">
                    <a href="javascript:;" class="name">{{ $user->name }}</a>
                </div>
                @if (!empty($user->last_message))
                    {{-- <p>{{ Str::limit($user->last_message, 20, '...') }} <span>{{ $user->last_message_timestamp->diffForHumans() }}</span></p> --}}
                    <p>{{ Str::limit($user->last_message, 20, '...') }} </p>
                @else
                    {{-- @if ($user->received_file)
                        {{ __("You have received a file")}}
                    @elseif($user->sent_file)
                    {{ __("You have sent a file ") }}
                    @endif --}}
                @endif

            </div>
        </div>
    </div>
@empty
    <div class="single-persion">
        <h5 class="fs-6">User not found</h5>
    </div>
@endforelse
