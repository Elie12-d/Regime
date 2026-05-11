<?php
namespace App\Controllers;

class StatistiquesController extends BaseController
{
    public function index()
    {
        // Afficher les statistiques de l'utilisateur
        $data['title'] = 'Regime - Statistiques';
        return view('Statistiques', $data);
    }
}