<?php

namespace App\Http\Controllers\Convocatories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inscription;
use App\Convocatory;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller {

    public function create($id) {
        $user = Auth::user();
        $convocatory = Convocatory::find($id);

        $inscription = new Inscription();
        $inscription->convocatory_id = $convocatory->id;
        $inscription->student_id = $user->id;
        $inscription->state = 1;
        $inscription->score = 0.0;
        $inscription->observations = '';
        $inscription->save();

        return redirect('convocatories/' . $convocatory->id);
    }

    public function edit($id, Request $request) {
        $rules = [
            'state' => 'required|integer|min:2|max:4',
            'score' => 'required|numeric|min:0|max:10',
            'observations' => 'required|string|max:' . config('forms.observations'),
        ];
        $this->validate($request, $rules);

        $inscription = Inscription::find($id);
        $inscription->state = $request->state;
        $inscription->score = $request->score;
        $inscription->observations = $request->observations;
        $inscription->save();

        return redirect('convocatories/' . $inscription->convocatory->id);
    }

    public function remove($id) {
        $inscription = Inscription::find($id);
        $inscription->delete();

        return redirect('convocatories/' . $inscription->convocatory->id);
    }

}
