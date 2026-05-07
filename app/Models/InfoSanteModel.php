<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoSanteModel extends Model
{
    protected $table = 'infoSante';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'poids', 'taille', 'categorieObjectif_id', 'dateEnregistrement'];
}
