<?php

namespace App\Controllers;

use App\Models\RegimesModel;
use App\Models\PorteMonnaieModel;

class PaiementController extends BaseController
{
    public function sauvegarderSession()
    {
        // Recuperatin donnees JSON
        $data = $this->request->getJSON();

        // Validation
        if (!$data || !isset($data->ids_regimes) || !isset($data->valeur)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Données incomplètes'
            ]);
        }

        // si le donnee est vide
        if (empty($data->ids_regimes)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Aucun régime sélectionné'
            ]);
        }

        // Stocker en session
        $donneesParcours = session()->get('donneesParcours');
        $donneesParcours['ids_regimes'] = $data->ids_regimes;
        $donneesParcours['valeur'] = $data->valeur;

        // mise a jour du session
        session()->set('donneesParcours', $donneesParcours);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Données sauvegardées avec succès'
        ]);
    }
    public function index()
    {
        $donneesParcours = session()->get('donneesParcours');

        if (session()->has('regimesGeneres')) {
            $listeRegimes = session()->get('regimesGeneres');
            $prixTotal = session()->get('prixTotal');

            $porteMonnaieModel = new PorteMonnaieModel();
            $wallet = $porteMonnaieModel->getPorteMonnaieByUserId(session()->get('id'));

            $data = [
                'listeRegimes' => $listeRegimes,
                'prixTotal' => $prixTotal,
                'solde' => $wallet['solde'] ?? 0
            ];

            return view('Paiement', $data);
        }


        // recupere les ids
        $idSelectionees = $donneesParcours['ids_regimes'];
        $regimesTraitementUser = [];
        $butOriginal = $donneesParcours['valeur'];
        $regimeModel = new RegimesModel();
        $categorieId = $donneesParcours['categorieObjectif_id'];
        $nbJours = 0;
        $poidsTotal = 0;
        while (true) {
            $idPrise = $idSelectionees[array_rand($idSelectionees)];
            $regime = $regimeModel->find($idPrise);

            if ($regime) {
                $regimesTraitementUser[] = $regime;
                $poidsTotal += $regime['variationPoids'];
                $nbJours++;

                if ($categorieId == 1) {
                    if (abs($poidsTotal) >= $butOriginal) {
                        break;
                    }
                } elseif ($categorieId == 2) {
                    if ($nbJours >= $butOriginal) {
                        break;
                    }
                } else {
                    if ($poidsTotal >= $butOriginal) {
                        break;
                    }
                }
            }
        }

        $prixTotal = 0;
        $idsRegimes = array_column($regimesTraitementUser, 'id');
        $occurrences = array_count_values($idsRegimes);
        $listeRegimes = [];
        foreach ($occurrences as $id => $nombre) {
            $prixTotal += $regimeModel->getPrixRegimeById($id) * $nombre;
            $regime = $regimeModel->find($id);
            $listeRegimes[] = [
                'id' => $regime['id'],
                'nom' => $regime['nom'],
                'description' => $regime['description'],
                'prix' => $regime['prixParJour'],
                'quantite' => $nombre,
                'sous_total' => $regime['prixParJour'] * $nombre
            ];
        }

        session()->set('regimesGeneres', $listeRegimes);
        session()->set('prixTotal', $prixTotal);

        $porteMonnaieModel = new PorteMonnaieModel();
        $wallet = $porteMonnaieModel->getPorteMonnaieByUserId(session()->get('id'));

        // envoi des data
        $data = [
            'listeRegimes' => $listeRegimes,
            'prixTotal' => $prixTotal,
            'solde' => $wallet['solde']
        ];

        return view('Paiement', $data);
    }
}