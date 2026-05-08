<?php

namespace App\Models;

use CodeIgniter\Model;

class ImcCategorisModel extends Model
{
    protected $table = 'imcCategories';
    protected $primaryKey = 'id';
    public function getCategorieByImc($imc)
    {
        if ($imc === null) {
            return null;
        }

        return $this->where('minImc <=', $imc)
            ->where('maxImc >', $imc)
            ->first();
    }
}
