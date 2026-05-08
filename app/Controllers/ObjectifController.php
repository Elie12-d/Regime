<?php

namespace App\Controllers;

class ObjectifController extends BaseController
{
    public function setObjectif($id)
    {
        // creation d'une session pour stocker les donnees du parcours
        if (!session()->has('donneesParcours')) {
            session()->set('donneesParcours', []);
        }
        // recuperation de la session
        $donneesParcours = session()->get('donneesParcours');

        // ajout de l'objectif a la session
        $donneesParcours['categorieObjectif_id'] = $id;

        // mise a jour de la session
        session()->set('donneesParcours', $donneesParcours);

        // redirection vers la page suivante du parcours
        return redirect()->to(site_url('/liste-regimes'));
    }
}
