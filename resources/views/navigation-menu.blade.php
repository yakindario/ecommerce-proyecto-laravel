<div>
    @if (Route::has('login'))
        @auth
            <x-navigation-user />
        @else
            <x-navigation-login />

        @endauth
    @endif
</div>
