<?php
namespace App\Controllers;

class StatistiquesController extends BaseController
{
    public function index()
    {
        // Afficher les statistiques de l'utilisateur
        return view('Statistiques');
    }
}