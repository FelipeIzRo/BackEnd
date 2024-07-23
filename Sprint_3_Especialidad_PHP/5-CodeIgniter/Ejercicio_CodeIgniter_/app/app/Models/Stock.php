<?php

namespace App\Models;

use CodeIgniter\Model;

class Stock extends Model
{
    protected $table            = 'stock';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'quantity',
        'price'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    //regex_match[/^[a-zA-Z0-9\s]+$/] Permitir letras numeros y espacios en blanco
    protected $validationRules      = [
        'name'=>'required|regex_match[/^[a-zA-Z0-9\s]+$/]|is_unique[stock.name]',
        'quantity'=>'required|integer|greater_than[0]',
        'price'=>'required|decimal|greater_than[0]',
    ];
    protected $validationMessages   = [
        'name'=>[
            'required'=>'El nombre del producto es obligatorio',
            'is_unique'=>'El nombre del producto esta repetido',
            'regex_match' => 'El nombre no acepta caracteres especiales'
        ],
        'quantity'=>[
            'required'=>'La cantidad de stock es obligatoria',
            'greater_than'=>'La cantidad debe ser mayor que 0',
            'integer'=>'La cantidad debe de ser un numero entero'
        ],
        'price'=>[
            'required'=>'El precio es un campo obligatorio',
            'greater_than'=>'El precio debe de ser mayor que 0.0',
            'decimal'=>'El precio debe de ser un numero decimal'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllStock()
    {
        return $this->findAll();
    }

    public function getOneStock($id)
    {
        return $this->where('id',$id)->first();
    }
    public function removeOne($id)
    {
        return $this->delete($id);
    }
    public function updateOne($id,$data)
    {
        return $this->set($id,$data);
    }
}
