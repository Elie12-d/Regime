<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimesModel extends Model
{
    protected $table = 'regimes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'description', 'categorieObjectif_id', 'pourcentageViande', 'pourcentageVolaille', 'pourcentagePoisson', 'prixParJour', 'variationPoids'];
    public function getRegimesByCategorieObjectif($categorieObjectifId)
    {
        return $this->where('categorieObjectif_id', $categorieObjectifId)->findAll();
    }
}
