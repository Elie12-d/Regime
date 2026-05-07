<?php

namespace App\Controllers;
use App\Models\UsersModel;
class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function testConnexion()
    {
        $usersModel = new UsersModel();
        $results = $usersModel->findAll();
        $data['users'] = $results;
        return view('testConnexion', $data);
    }
}
