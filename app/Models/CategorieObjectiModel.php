<?php

namespace App\Models;

use CodeIgniter\Model;

class CategorieObjectiModel extends Model
{
    protected $table = 'categorieObjectif';
    protected $primaryKey = 'id';
    protected $allowedFields = ['label'];
}