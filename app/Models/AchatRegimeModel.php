<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatRegimeModel extends Model
{
    protected $table = 'achatRegime';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'regime_id', 'prixPaye', 'dateAchat', 'dateDebut', 'dateFin'];
}
