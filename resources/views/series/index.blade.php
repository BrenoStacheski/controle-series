<x-layout title="Séries">
    <a href="/series/criar" class="btn btn-dark mb-2">Adicionar</a>

    @isset($mensagemSucesso)
    <div class="alert alert-success">
        {{ $mensagemSucesso }}
    </div>
    @endisset
    
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('seasons.index', $serie->id) }}">
                {{ $serie->nome }}
            </a>

            <span class="d-flex">
                <a href="/series/editar/{{ $serie->id }}" class="btn btn-primary btn-sm">
                Editar
                </a>

                <form action="{{route ('series.destroy', $serie->id) }}" method="POST" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        X
                    </button>
                </form>
            </span>
        </li>
        @endforeach
    </ul>

    <script>
        const series = {{Js::from($series)}};
    </script>
</x-layout>