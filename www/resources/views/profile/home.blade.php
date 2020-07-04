@extends("layouts.base")
@include("auth.header")

@section("body")
<section id="main-content">
    <div class="alert alert-{{ session('status') }}">{{ session("message") }}</div>
    <div id="insert-record">
        <p>Cambia password</p>
        <form action="{{ route('edit-profile') }}" method="post">
            @csrf
            <input class="nama-input-field" type="password" name="old_password" placeholder="Vecchia Password">
            <input class="nama-input-field" type="password" name="password" placeholder="Nuova Password">
            <input class="nama-input-field" type="password" name="re_password" placeholder="Ripeti nuova password">
            <input class="nama-input-button" type="submit" name="submit" value="Aggiorna password">
        </form>
    </div>
    <!-- <div id="insert-record">
        <p>Richiedi modifiche al locale</p>
        <form action="{{ route('edit-profile') }}" method="post">
            @csrf
            <input class="nama-input-field" type="text" name="nome_ristorante" placeholder="Nome locale">
            <input class="nama-input-field" type="email" name="email" placeholder="Email">
            <input class="nama-input-button" type="submit" name="submit" value="Richiedi modifica">
            <p>Le modifiche devono essere approvate dal tuo commerciale di riferimento</p>
        </form>
    </div> -->
</section>
@include("auth.footer")
@endsection("body")