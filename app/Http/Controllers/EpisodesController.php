<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EpisodesController
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season)
    {
        $watchedEpisodes = $request->episodes;
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });

        $season->push();

        $watchedEpisodes_string = implode(', ', $watchedEpisodes);
        return view('episodes.index', ['episodes' => $season->episodes, 'mensagemSucesso' => 'Episódio ' . $watchedEpisodes_string . ' marcado(s) como assistido!']);
    }
}