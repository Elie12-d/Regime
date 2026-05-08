<?php

namespace App\Controllers;

use App\Models\UsersModel;

class AchatRegime extends BaseController {
    public function index()
    {
        $session = session();

        $idUser = $session->get('idUser');

        return view('AchatRegime', [
            'idUser' => $idUser
        ]);
    }
}