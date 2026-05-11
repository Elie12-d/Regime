<?php

namespace App\Controllers;

use App\Models\InfoSanteModel;
use App\Models\AchatRegimeModel;
use App\Models\RegimesModel;
use App\Models\UsersModel;

class StatistiquesController extends BaseController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        $session = session();
        if (!$session->get('id')) {
            return redirect()->to('/');
        }

        $userId = $session->get('id');

        // Charger les modèles
        $infoSanteModel = new InfoSanteModel();
        $achatRegimeModel = new AchatRegimeModel();
        $regimesModel = new RegimesModel();
        $usersModel = new UsersModel();

        // Récupérer les informations de santé (poids initial et date)
        $infoSante = $infoSanteModel->where('user_id', $userId)->first();

        // Récupérer les achats de régimes triés par dateAchat
        $achats = $achatRegimeModel
            ->where('user_id', $userId)
            ->orderBy('dateAchat', 'ASC')
            ->findAll();

        // Récupérer les infos des régimes pour chaque achat
        $poidInitial = $infoSante ? (float)$infoSante['poids'] : 0;
        $dateDebut = $infoSante ? $infoSante['dateEnregistrement'] : date('Y-m-d');
        $poidActuel = $poidInitial;
        $achatsDetailles = [];
        $chartData = [];

        // Ajouter le point de départ au graphique
        $chartData[] = [
            'date' => $dateDebut,
            'poids' => $poidInitial
        ];

        // Calculer le poids actuel basé sur les régimes consommés
        foreach ($achats as $achat) {
            $regime = $regimesModel->find($achat['regime_id']);
            if ($regime) {
                // Supposant 1 régime par jour
                $variation = isset($regime['variationPoids']) ? (float)$regime['variationPoids'] : 0;
                $poidActuel += $variation;
                
                $achatsDetailles[] = [
                    'id' => $achat['id'],
                    'regime' => $regime['nom'],
                    'dateAchat' => $achat['dateAchat'],
                    'variation' => $variation,
                    'poids_apres' => $poidActuel,
                    'quantite' => $achat['quantite'],
                    'prixPaye' => $achat['prixPaye']
                ];

                $chartData[] = [
                    'date' => $achat['dateAchat'],
                    'poids' => $poidActuel
                ];
            }
        }

        // Récupérer l'objectif de l'utilisateur
        $user = $usersModel->find($userId);
        $objectifPoids = $infoSante ? (float)$infoSante['categorieObjectif_id'] : null;

        // Calculer les statistiques
        $totalRegimesConsommes = count($achatsDetailles);
        $dateActuelle = date('Y-m-d');
        $joursEcules = ceil((strtotime($dateActuelle) - strtotime($dateDebut)) / (60 * 60 * 24));
        $variationTotale = $poidActuel - $poidInitial;

        // Préparer les données pour les graphiques
        $dates = array_map(fn($data) => $data['date'], $chartData);
        $poids = array_map(fn($data) => $data['poids'], $chartData);

        // Compter les régimes par type (si applicable)
        $regimesCounts = [];
        foreach ($achatsDetailles as $achat) {
            $regime = $achat['regime'];
            $regimesCounts[$regime] = ($regimesCounts[$regime] ?? 0) + 1;
        }

        $data = [
            'poidInitial' => $poidInitial,
            'dateDebut' => $dateDebut,
            'poidActuel' => $poidActuel,
            'dateActuelle' => $dateActuelle,
            'joursEcules' => $joursEcules,
            'variationTotale' => $variationTotale,
            'objectifPoids' => $objectifPoids,
            'totalRegimesConsommes' => $totalRegimesConsommes,
            'achatsDetailles' => $achatsDetailles,
            'dates' => json_encode($dates),
            'poids' => json_encode($poids),
            'regimesCounts' => $regimesCounts,
            'chartData' => json_encode($chartData)
        ];

        return view('Statistiques', $data);
    }
}
