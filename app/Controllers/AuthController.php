<?php

namespace App\Controllers;
use App\Models\UsersModel;

class AuthController extends BaseController
{

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = new UsersModel();
        $user = $model->where('email', $email)->first();

        if (!$user || $user['password'] !== $password) {
            return redirect()->to('/')->with('error', 'Email d’utilisateur ou mot de passe incorrect.');
        }

        session()->set('id', $user['id']);

        return redirect()->to('/dashboard');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
