<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::query()->get();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)
        ->with('mensagemSucesso', $mensagemSucesso); //->with('series', $series); TBM DA PRA USAR
    } 

    public function create() 
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $nome = $request->nome;
        $serie = new Series();
        $serie->nome = $nome;
        $serie->save();
        $seasons = [];

        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i,
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->seasons as $season) {
            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }
        }
        Episode::insert($episodes);
    
        return Redirect::to('series')
        ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!");
    }

    public function destroy(Request $request, $id)
    {
        $serie = Series::where('id', $id)->first();
        $serie->delete();

        return view('series.index', ['mensagemSucesso' => "Série '{$serie->nome}' removida com sucesso", 'series' => Series::all()]);
    }

    public function edit(Request $request, $id)
    {
        $serie = Series::where('id', $id)->first();
        if (empty($serie)) {
            return "Série inexistente";
        } else {
            return view('series.edit')->with('serie', $serie);
        }
    }

    public function update(SeriesFormRequest $request, $id)
    {
        $serie = Series::where('id', $id)->first();
        if (empty($serie)) {
            return "Série inexistente";
        } else {
            $serie->nome = $request->nome;
            $serie->save();
            return view('series.index')->with('series', Series::all());
        }
    }
}
