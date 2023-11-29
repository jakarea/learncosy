@if ( $user )
    <div class="message-item sender-item">
        <div class="media main-media">
            <div class="avatar">
                @isset( $user->avatar )
                    <img src="{{ asset($user->avatar) }}" class="img-fluid" alt="{!! strtoupper($user->name[0]) !!}">
                @else
                    <span class="user-name-avatar">{!! strtoupper($user->name[0]) !!}</span>
                @endisset
                <i class="fas fa-circle"></i>
            </div>
            <div class="media-body">
                <div class="d-flex">
                    <h6 class="open-profile">{{ $user->name }} &nbsp; </h6>
                    <span> {{ $user->created_at->format('F j, Y') }}
                    </span>
                </div>

                <div class="text">
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    </div>
@endif
