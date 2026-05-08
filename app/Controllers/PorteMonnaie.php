<?php

namespace App\Controllers;

use App\Models\PorteMonnaieModel;

class PorteMonnaie extends BaseController
{
    public function index()
    {
        $model = new PorteMonnaieModel();
        $porteMonnaie = $model->getPorteMonnaieByUserId(session()->get('id'));
        $data['porteMonnaie'] = $porteMonnaie;
        return view('PorteMonnaie', $data);
    }
}
