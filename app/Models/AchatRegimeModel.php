<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatRegimeModel extends Model
{
    protected $table = 'achatRegime';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'regime_id', 'prixPaye', 'dateAchat', 'dateDebut', 'dateFin'];

    public function getAchatByUserId($userId)
    {
        $regime =  $this->where('user_id', $userId)->findAll();
        
        if ($regime) {
            return true;
        }   else {
            return false;
        }
    }
}
