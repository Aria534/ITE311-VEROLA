<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;
use CodeIgniter\Controller;

class Announcements extends BaseController
{
    protected $announcementModel;

    public function __construct()
    {
        $this->announcementModel = new AnnouncementModel();
    }

    /**
     * Display all announcements (sorted by latest first)
     */
    public function index()
    {
        $data = [
            'announcements' => $this->announcementModel
                ->orderBy('created_at', 'DESC')
                ->findAll(),
        ];

        return view('announcements/index', $data);
    }

    /**
     * Show a single announcement by ID
     */
    public function show($id = null)
    {
        $announcement = $this->announcementModel->find($id);

        if (!$announcement) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Announcement not found.');
        }

        return view('announcements/show', ['announcement' => $announcement]);
    }
}
