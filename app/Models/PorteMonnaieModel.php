<?php

namespace App\Models;

use CodeIgniter\Model;

class PorteMonnaieModel extends Model
{
    protected $table = 'porteMonnaie';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'solde'];
}