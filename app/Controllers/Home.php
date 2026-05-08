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

        // recuperation de tout les imc
        $imcs = $imcCategoriesModel->findAll();

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
            'categorieObjectif' => $categorieObjectif,
            'imcs' => $imcs
        ];
        return view('Dashboard', $data);
    }

    public function init1() {

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = new UsersModel();
        $user = $model->where('email', $email)->first();

        if (!$user || $user['password'] !== $password) {
            return redirect()->to('/')->with('error', 'Email d’utilisateur ou mot de passe incorrect.');
        }

        session()->set('user', [
            'id' => $user['id'],
            'email' => $user['email'],
        ]);
        
        return redirect()->to('/dashboard');
    }
}
