<div class="container">
    @if (Session::has('message') && Session::has('message_type'))
        <div class="alert alert-{{ Session::get('message_type') }} text-center">
            {{ Session::get('message') }}
        </div>
    @endif
</div>

