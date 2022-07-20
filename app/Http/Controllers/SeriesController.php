<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)
        ->with('mensagemSucesso', $mensagemSucesso); //->with('series', $series); TBM DA PRA USAR
    } 

    public function create() 
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $serie = Serie::create($request->all());

        return Redirect::to('series')
        ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!");
    }

    public function destroy(Serie $id)
    {
        $id->delete();

        return Redirect::to('series')
        ->with('mensagem.sucesso', "Série '{$id->nome}' removida com sucesso");
    }
}
