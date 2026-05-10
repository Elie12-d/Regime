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

        // get idCategorieObjectif
        $idCategorieObjectif = $donneesParcours['categorieObjectif_id'];

        // passer les regimes à la vue
        $data = [
            'regimes' =>$regimes,
            'idCategorieObjectif' => $idCategorieObjectif
        ];

        $data['title'] = 'Regime - Liste Regimes';
        return view('ListeRegimes', $data);
    }
    public function setCommande($kgOuNbJour, $idRegime)
    {
        // get session parcours
        $donneesParcours = session()->get('donneesParcours');

        // ajout du regime a la session
        $donneesParcours['regime_id'] = $idRegime;

        if($donneesParcours['categorieObjectif_id'] == 1) {
            $regimeModel = new RegimesModel();
            $regime = $regimeModel->find($idRegime);
            $variationPoids = $regime['variationPoids'];
            $duree = ceil($kgOuNbJour / $variationPoids);
            $prixGold = $regime['prixParJour'] * $duree;
        }

        // mise a jour de la session
        session()->set('donneesParcours', $donneesParcours);

        // vers pop-up de confirmation de commande
        return redirect()->to(site_url('/traitements'));
    }
}
