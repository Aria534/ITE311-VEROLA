<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'message', 'is_read', 'created_at'];

    public function getUnreadCount($userId)
    {
        return $this->where('user_id', $userId)->where('is_read', 0)->countAllResults();
    }

    public function getNotificationsForUser($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll(10); // latest 10
    }

    public function markAsRead($id)
    {
        return $this->update($id, ['is_read' => 1]);
    }
}
