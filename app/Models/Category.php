<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table            = 'category';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|min_length[2]|max_length[50]|is_unique[category.name]',
    ];
    protected $validationMessages   = [
        'name' => [
            'required'   => 'Category name is required.',
            'min_length' => 'Category name must be at least 2 characters.',
            'max_length' => 'Category name cannot exceed 50 characters.',
            'is_unique'  => 'That category already exists.',
        ],
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

    public function withBookCount(): array
    {
        return $this->db->table('category')
            ->select('category.id, category.name, COUNT(category_book.book_id) AS book_count')
            ->join('category_book', 'category_book.category_id = category.id', 'left')
            ->groupBy('category.id')
            ->get()
            ->getResultArray();
    }
}
