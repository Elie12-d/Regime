<?php

namespace App\Controllers;

use App\Models\RegimesModel;

class RegimeController extends BaseController
{
    public function index()
    {

    }

    public function afficherRegimesByIdCategorie()
    {
        // get session parcours
        $donneesParcours = session()->get('donneesParcours');

        // instantiation regime
        $regimeModel = new RegimesModel();

        // get regimes by idCategorie
        $regimes = $regimeModel->getRegimesByCategorieObjectif($donneesParcours['categorieObjectif_id']);

        // passer les regimes à la vue
        $data['regimes'] = $regimes;
        return view('ListeRegimes', $data);
    }
}
