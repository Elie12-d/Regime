<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\InfoSanteModel;
use App\Models\ImcCategorisModel;
use App\Models\CategorieObjectiModel;

class Home extends BaseController
{
    public function index()
    {
        session()->set('id', 3);
        return view('Login');
    }
    public function testConnexion()
    {
        $usersModel = new UsersModel();
        $results = $usersModel->findAll();
        $data['users'] = $results;
        return view('testConnexion', $data);
    }
    public function init()
    {
        // instanciation des models
        $infoSanteModel = new InfoSanteModel();
        $imcCategoriesModel = new ImcCategorisModel();

        // get les infos de l'user
        $userSante = $infoSanteModel->getPoidsTailleByUser(session()->get('id'));

        // calcul l'imc
        $poids = $userSante['poids'];
        $taille = $userSante['taille'];
        $imc = $infoSanteModel->calculerImc($poids, $taille);

        // recupere la categorie correspondnte
        $categorie = $imcCategoriesModel->getCategorieByImc($imc);

        // get le label et la description
        $label = $categorie ? $categorie['label'] : null;
        $description = $categorie ? $categorie['description'] : "Ces donnees n'existe pas dans notre base";

        // get categorie objectif
        $categorieObjectifModel = new CategorieObjectiModel();
        $categorieObjectif = $categorieObjectifModel->findAll();

        // evoi des donnees
        $data = [
            'imc' => $imc,
            'titre' => $label,
            'description' => $description,
            'categorieObjectif' => $categorieObjectif
        ];
        return view('Dashboard', $data);
    }
}
