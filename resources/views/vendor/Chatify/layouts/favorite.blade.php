<div class="favorite-list-item">
    @if ($user)
        <div class="avatar av-l upload-avatar-preview chatify-d-flex"
            style="background-image: url('{{ asset('uploads/avatar/' . $user->avatar ?? 'avatar_default.jpg') }}');"></div>
        <p>{{ strlen($user->fullname) > 5 ? substr($user->fullname, 0, 6) . '..' : $user->fullname }}</p>
    @endif
</div>
