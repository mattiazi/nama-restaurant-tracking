@extends("layouts.base")

@section("body")
<div id="login-form">
    <div id="login-form-container">
        <div id="login-form-logo">
            <img src="/assets/nama-logo-hor.png" alt="">
        </div>
        <hr>
        <form id="login-form-fields" action="/login" method="post">
            @csrf
            <input class="nama-input-field" type="email" name="email" placeholder="E-mail">
            <input class="nama-input-field" type="password" name="password" placeholder="Password">
            <input class="nama-input-button" type="submit" name="submit" value="Entra">
        </form>
    </div>
    <br><br>
    <div class="alert alert-{{ session('status') }}">{{ session("message") }}</div>
</div>
@endsection("body")