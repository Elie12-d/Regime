<?php

namespace App\Controllers;

use App\Models\PorteMonnaieModel;
use App\Models\CodesModel;

class PorteMonnaie extends BaseController
{
    public function index()
    {
        $model = new PorteMonnaieModel();
        $porteMonnaie = $model->getPorteMonnaieByUserId(session()->get('id'));
        $data['porteMonnaie'] = $porteMonnaie;
        $data['title'] = 'Regime - Porte Monnaie';
        $data['activePage'] = 'wallet';
        return view('PorteMonnaie', $data);
    }

    public function recharger()
    {
        // instantiation du model
        $porteMonnaieModel = new PorteMonnaieModel();

        // recuperation du code et de l'id utilisateur
        $code = $this->request->getPost('code');
        $userId = session()->get('id');

        // instantiation du code model
        $codeModel = new CodesModel();

        // recuperation du code
        $code = $codeModel->where('codeValeur', $code)->first();

        // verification du code
        if (!$code || $code['isUsed']) {
            return redirect()->to('/porte-monnaie')->with('error', 'Code invalide ou déjà utilisé.');
        }
        // mise a jour du solde
        $porteMonnaieModel->update($userId, ['solde' => $porteMonnaieModel->getPorteMonnaieByUserId($userId)['solde'] + $code['montant']]);

        // marquer le code comme utilisé
        $codeModel->update($code['id'], ['isUsed' => TRUE]);

        return redirect()->to('/porte-monnaie')->with('success', 'Porte-monnaie rechargé avec succès !');
    }
}
