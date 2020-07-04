@extends("layouts.base")

@section("body")
<div id="login-form">
    <div id="login-form-container">
        <div id="login-form-logo">
            <img src="/assets/nama-logo-hor.png" alt="">
        </div>
        <hr>
        <form id="login-form-fields" action="/register" method="post">
            @csrf
            <input class="nama-input-field" type="text" name="nome_ristorante" placeholder="Nome ristorante">
            <input class="nama-input-field" type="email" name="email" placeholder="E-mail">
            <input class="nama-input-field" type="password" name="password" placeholder="Password">
            <input class="nama-input-field" type="password" name="re_password" placeholder="Ripeti password">
            <input class="nama-input-field" type="text" name="code" placeholder="Submission code">
            <input class="nama-input-button" type="submit" name="submit" value="Registrati">
        </form>
    </div>
    <br><br>
    <div class="alert alert-{{ session('status') }}">{{ session("message") }}</div>
</div>
@endsection("body")