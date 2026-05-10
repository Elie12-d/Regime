<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\InfoSanteModel;
use App\Models\ImcCategorisModel;
use App\Models\CategorieObjectiModel;
use App\Models\PorteMonnaieModel;

class Home extends BaseController
{
    public function index()
    {
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
        $data['title'] = 'Regime -  Dashboard';
        return view('Dashboard', $data);
    }

    public function inscription() {
        return view('Inscription');
    }

    public function ajoutInscription() {
        $pseudo = $this->request->getPost('pseudo');
        $genre = $this->request->getPost('genre');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $taille = $this->request->getPost('taille');
        $poids = $this->request->getPost('poids');

        // Enregistrer les données dans la base de données
        $usersModel = new UsersModel();
        $userId = $usersModel->insert([
            'pseudo' => $pseudo,
            'genre' => $genre,
            'email' => $email,
            'password' => $password
        ]);

        if ($userId) {
            // Enregistrer les informations de santé
            $infoSanteModel = new InfoSanteModel();
            $infoSanteModel->insert([
                'user_id' => $userId,
                'taille' => $taille,
                'poids' => $poids
            ]);

            // Initialiser le porte-monnaie de l'utilisateur
            $porteMonnaieModel = new PorteMonnaieModel();
            $porteMonnaieModel->insert([
                'user_id' => $userId,
                'solde' => 0.00
            ]);



            $infoSanteModel = new InfoSanteModel();
            $infoSanteModel->insert([
                'user_id' => $userId,
                'taille' => $taille,
                'poids' => $poids,
                'categorieObjectif_id' => NULL,
                'dateEnregistrement' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to('/');
        } else {
            return redirect()->to('/inscription')->with('error', 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.');
        }
    }
}