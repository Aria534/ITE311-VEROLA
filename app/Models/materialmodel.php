<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'course_id',
        'file_name',
        'file_path',
        'uploaded_by',
        'created_at'
    ];
}
