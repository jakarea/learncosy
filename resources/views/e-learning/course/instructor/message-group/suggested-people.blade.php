<div class="suggest-user" id="{{ $user->id }}">
    <img src="{{ asset( $user->avatar ) }}" alt="{{ $user->name }}" class="img-fluid">
    <span>{{ $user->name ?? "Jon Doe" }}</span>
    <a href="javascript:;" class="remove-suggested-people">
        <i class="fas fa-close"></i>
    </a>
</div>
