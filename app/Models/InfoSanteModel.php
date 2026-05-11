<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoSanteModel extends Model
{
    protected $table = 'infoSante';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'poids', 'taille', 'categorieObjectif_id', 'dateEnregistrement'];
    public function getPoidsTailleByUser($userId)
    {
        return $this->where('user_id', $userId)->first();
    }

    public function calculerImc($poids, $taille)
    {
        if ($taille <= 0 || $poids <= 0) {
            return null;
        }
        // $tailleM = $taille / 100;
        return round($poids / ($taille * $taille), 1);
    }
}
