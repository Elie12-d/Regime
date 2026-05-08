<?php

namespace App\Models;

use CodeIgniter\Model;

class CodesModel extends Model
{
    protected $table = 'codes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['codeValeur', 'montant', 'isUsed'];
}
