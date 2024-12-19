<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModels extends Model
{
    protected $table = 'm_product';
    protected $primaryKey = 'id_product';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = [
        'code_product',
        'name_product',
        'stock'
    ];
}