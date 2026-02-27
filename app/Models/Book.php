<?php

namespace App\Models;

use CodeIgniter\Model;

class Book extends Model
{
    protected $table            = 'book';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['uid', 'category_id', 'title', 'author', 'publisher', 'release_date', 'sipnosis', 'img_url', 'price'];

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
        'title'        => 'required|min_length[3]|max_length[255]',
        'author'       => 'required|min_length[3]|max_length[255]',
        'publisher'    => 'required|max_length[64]',
        'release_date' => 'required|valid_date',
        'price'        => 'required|integer|greater_than_equal_to[0]',
        'category_id'  => 'permit_empty|integer',
        'sipnosis'     => 'permit_empty|max_length[255]',
    ];
    protected $validationMessages   = [
        'title'     => ['required' => 'Book title is required.'],
        'author'    => ['required' => 'Author name is required.'],
        'publisher' => [
            'required'   => 'Publisher is required.',
            'max_length' => 'Publisher name cannot exceed 64 characters.',
        ],
        'price'     => [
            'required'              => 'Price is required.',
            'integer'               => 'Price must be a whole number.',
            'greater_than_equal_to' => 'Price cannot be negative.',
        ],
        'release_date' => ['required' => 'Release date is required.'],
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
}
