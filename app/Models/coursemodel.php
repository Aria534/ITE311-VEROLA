<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';           // Your database table name
    protected $primaryKey = 'id';           // Primary key column

    // Fields allowed for insert/update
    protected $allowedFields = [
        'course_code',
        'title',
        'description',
        'units',
        'created_at',
        'updated_at'
    ];

    // Automatically manage created_at / updated_at timestamps
    protected $useTimestamps = true;

    // Optional: Define how results are returned
    protected $returnType = 'array';
}
