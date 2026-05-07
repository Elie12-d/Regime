<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivitePhisiqueModel extends Model
{
    protected $table = 'activitePhisique';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'description', 'categorieObjectif_id', 'durationMinutes', 'caloriesBrulees'];
}
