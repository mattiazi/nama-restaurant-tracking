@extends("layouts.base")
@include("auth.header")

@section("body")
<section id="main-content">
    <div id="insert-record">
        <p>Inserisci un nuovo record</p>
        <form action="{{ route('insert-person') }}" method="post">
            @csrf
            <input class="nama-input-field" type="text" name="nome" placeholder="Nome">
            <input class="nama-input-field" type="text" name="cognome" placeholder="Cognome">
            <input class="nama-input-field" type="text" name="telefono" placeholder="Numero di Telefono">
            <input class="nama-input-button" type="submit" name="submit" value="Inserisci">
        </form>
    </div>
    <div class="alert alert-{{ session('status') }}">{{ session("message") }}</div>
    <div id="records">
        <table>
            <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Numero di telefono</th>
                <th scope="col">Data registrazione</th>
                <th scope="col">Elimina</th>
            </tr>
            </thead>
            <tbody>
            @foreach($people as $person)
                <tr>
                    <th scope="col">{{ $person->nome }}</th>
                    <th scope="col">{{ $person->cognome }}</th>
                    <th scope="col">{{ $person->telefono }}</th>
                    <th scope="col">{{ $person->created_at }}</th>
                    <th scope="col"><a href="{{ route('delete-person', ['id' => $person->id]) }}"><span class="material-icons delete-icon">delete</span></a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="pagination">
            <a href="#">Filtra per data</a>
            {{ $people->links("pagination.simplePagination") }}
        </div>
    </div>
</section>
@include("auth.footer")
@endsection("body")