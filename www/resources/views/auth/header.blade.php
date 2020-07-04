<header id="aut-header">
    <div id="aut-header-container">
        <div id="aut-header-logo">
            <a href="{{ route('home') }}"><img src="/assets/nama-only-logo.png" alt=""></a>
        </div>
        <div id="aut-header-data">
        <a href="{{ route('profile-home') }}">{{ Auth::user()->nome_ristorante }}</a> | <a href="{{ route('logout') }}">Esci</a>
        </div>
    </div>
</header>