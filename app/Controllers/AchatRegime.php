<?php

namespace App\Controllers;

use App\Models\AchatRegimeModel;
use App\Models\PorteMonnaieModel;

class AchatRegime extends BaseController {
    public function index()
    {
        $model = new AchatRegimeModel();
        $listRegimes = $model->getAchatByUserId(session()->get('id'));
        $listRegimesByDate = [];

        foreach ($listRegimes as $regime) {
            $dateKey = $regime['dateAchat'];
            if (!isset($listRegimesByDate[$dateKey])) {
                $listRegimesByDate[$dateKey] = [];
            }
            $listRegimesByDate[$dateKey][] = $regime;
        }

        $data['listRegimesByDate'] = $listRegimesByDate;
        $data['title'] = 'Regime - Liste Traitements';
        return view('listTraitement', $data);
    }

    public function payer()
    {
        $session = session();
        $userId = $session->get('id');

        if (!$userId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Utilisateur non connecté.'
            ]);
        }

        $data = $this->request->getJSON();

        if (!$data || !isset($data->regimes) || !isset($data->prixTotal)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Données de paiement incomplètes.'
            ]);
        }

        if (!is_array($data->regimes) || empty($data->regimes)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Aucun régime à payer.'
            ]);
        }

        $porteMonnaieModel = new PorteMonnaieModel();
        $wallet = $porteMonnaieModel->getPorteMonnaieByUserId($userId);

        if (!$wallet || !isset($wallet['solde'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Porte-monnaie introuvable.'
            ]);
        }

        $totalAPayer = floatval($data->prixTotal);
        $soldeActuel = floatval($wallet['solde']);

        if ($soldeActuel < $totalAPayer) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Solde insuffisant.'
            ]);
        }

        $achatRegimeModel = new AchatRegimeModel();
        $dateAchat = date('Y-m-d H:i:s');

        foreach ($data->regimes as $regime) {
            if (!isset($regime->regime_id, $regime->quantite, $regime->prixPaye)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Format des régimes invalide.'
                ]);
            }

            $achatRegimeModel->insert([
                'user_id' => $userId,
                'regime_id' => $regime->regime_id,
                'quantite' => intval($regime->quantite),
                'prixPaye' => floatval($regime->prixPaye),
                'dateAchat' => $dateAchat
            ]);
        }

        $newBalance = $soldeActuel - $totalAPayer;
        $porteMonnaieModel->update($wallet['id'], ['solde' => $newBalance]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Paiement effectué avec succès.'
        ]);
    }

    public function exportPdf()
    {
        $userId = session()->get('id');
        if (!$userId) {
            return redirect()->to('/');
        }

        $model = new AchatRegimeModel();
        $listRegimes = $model->getAchatByUserId($userId);

        require APPPATH . 'Views/pdf.php';
        return null;
    }
}