<x-layout title="Editar Série">
    <form action="/series/atualizar/{{ $serie->id }}" method="PUT">
        @csrf
        <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input value="{{ $serie->nome }}" type="text" id="nome" name="nome" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
</x-layout>