@if(auth()->user()->is_team || auth()->user()->type == 'employee')
@include('nav.leftmenu-team')
@endif

@if(auth()->user()->is_client)
@include('nav.leftmenu-client')
@endif