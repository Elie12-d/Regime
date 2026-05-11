<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UsersModel;

class RegimesModel extends Model
{
    protected $table = 'regimes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'description', 'categorieObjectif_id', 'pourcentageViande', 'pourcentageVolaille', 'pourcentagePoisson', 'prixParJour', 'variationPoids'];
    public function getRegimesByCategorieObjectif($categorieObjectifId)
    {
        return $this->where('categorieObjectif_id', $categorieObjectifId)->findAll();
    }
    public function getPrixRegimeById($id)
    {
        $userModel = new UsersModel();
        $userId = session()->get('id');
        $user = $userModel->where('id', $userId)->first();

        // verifie si gold ou pas
        if ($user['isGold'] == TRUE) {
            return $this->find($id)['prixParJour'] * 0.85;
        } else {
            return $this->find($id)['prixParJour'];
        }
    }
}
