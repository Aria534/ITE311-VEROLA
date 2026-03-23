<?php

namespace App\Controllers;

use App\Models\NotificationModel;

class Notifications extends BaseController
{
    protected $notificationModel;
    protected $session;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
        $this->session = session();
    }

    /**
     * GET: Fetch unread notifications for the logged-in user.
     */
    public function get()
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'User not logged in'
            ]);
        }

        $count = $this->notificationModel->getUnreadCount($userId);
        $notifications = $this->notificationModel->getNotificationsForUser($userId);

        return $this->response->setJSON([
            'success' => true,
            'count' => $count,
            'notifications' => $notifications
        ]);
    }

    /**
     * POST: Mark a notification as read.
     */
    public function mark_as_read($id = null)
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'User not logged in'
            ]);
        }

        if (empty($id)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Notification ID is required'
            ]);
        }

        $updated = $this->notificationModel->markAsRead($id);

        return $this->response->setJSON([
            'success' => $updated,
            'message' => $updated ? 'Notification marked as read' : 'Failed to update notification'
        ]);
    }
}
