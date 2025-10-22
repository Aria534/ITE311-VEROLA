<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\AnnouncementModel;
use App\Models\MaterialModel;

class Student extends BaseController
{
    protected $enrollmentModel;
    protected $announcementModel;
    protected $materialModel;

    public function __construct()
    {
        $this->enrollmentModel = new EnrollmentModel();
        $this->announcementModel = new AnnouncementModel();
        $this->materialModel = new MaterialModel();
    }

    public function dashboard()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'student') {
            return redirect()->to(base_url('login'));
        }

        $userId = session()->get('user_id');

        // Fetch enrolled courses
        $enrollments = $this->enrollmentModel->getUserEnrollments($userId);

        // Fetch recent announcements (limit to 5)
        $announcements = $this->announcementModel->orderBy('created_at', 'DESC')->findAll(5);

        // Fetch materials for enrolled courses
        $materials = [];
        foreach ($enrollments as $enrollment) {
            $courseMaterials = $this->materialModel->getMaterialsByCourse($enrollment['course_id']);
            $materials = array_merge($materials, $courseMaterials);
        }

        return view('student/dashboard', [
            'username' => session()->get('username'),
            'enrollments' => $enrollments,
            'announcements' => $announcements,
            'materials' => $materials
        ]);
    }
}
