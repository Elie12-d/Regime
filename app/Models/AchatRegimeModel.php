<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatRegimeModel extends Model
{
    protected $table = 'achatRegime';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'regime_id', 'quantite', 'prixPaye', 'dateAchat'];

    public function getAchatByUserId($userId)
    {
        return $this->select('achatRegime.id as achat_id, achatRegime.quantite, achatRegime.prixPaye, achatRegime.dateAchat, regimes.*')
            ->join('regimes', 'regimes.id = achatRegime.regime_id')
            ->where('achatRegime.user_id', $userId)
            ->orderBy('achatRegime.dateAchat', 'DESC')
            ->findAll();
    }
}
