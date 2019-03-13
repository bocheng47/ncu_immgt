{{-- if the user's been authenticated --}}
@php
    $auth = false
@endphp
@auth
    @if( (Auth::user()->usertype == 0) )
        @php
            $auth = true
        @endphp
    @endif
@endauth
{{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}
