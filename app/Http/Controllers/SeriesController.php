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
        $nome = $request->nome;
        $serie = new Serie();
        $serie->nome = $nome;
        $serie->save();

        return Redirect::to('series')
        ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!");
    }

    public function destroy(Request $request, $id)
    {
        $serie = Serie::where('id', $id)->first();
        $serie->delete();

        return view('series.index', ['mensagemSucesso' => "Série '{$serie->nome}' removida com sucesso", 'series' => Serie::all()]);
    }

    public function edit(Request $request, $id)
    {
        $serie = Serie::where('id', $id)->first();
        if (empty($serie)) {
            return "Série inexistente";
        } else {
            return view('series.edit')->with('serie', $serie);
        }
    }

    public function update(Request $request, $id)
    {
        $serie = Serie::where('id', $id)->first();
        if (empty($serie)) {
            return "Série inexistente";
        } else {
            $serie->nome = $request->nome;
            $serie->save();
            return view('series.index')->with('series', Serie::all());
        }
    }
}
