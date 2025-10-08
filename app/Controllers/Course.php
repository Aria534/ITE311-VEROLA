<?php


namespace App\Controllers;


use App\Models\EnrollmentModel;


class Course extends BaseController
{
protected $enrollmentModel;
protected $session;


public function __construct()
{
$this->enrollmentModel = new EnrollmentModel();
$this->session = session();
helper('url');
}


/**
* Handles AJAX enrollment requests
*/
public function enroll()
{
// Expect AJAX POST
if (! $this->request->isAJAX()) {
return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'Invalid request']);
}


$user_id = $this->session->get('user_id');
if (! $user_id) {
return $this->response->setStatusCode(401)->setJSON(['status' => 'error', 'message' => 'Please login']);
}


$course_id = $this->request->getPost('course_id');
if (! $course_id) {
return $this->response->setJSON(['status' => 'error', 'message' => 'Missing course id']);
}


if ($this->enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
return $this->response->setJSON(['status' => 'error', 'message' => 'You are already enrolled in this course']);
}


$data = [
'user_id' => $user_id,
'course_id' => $course_id,
'enrollment_date' => date('Y-m-d H:i:s'),
];


$insertId = $this->enrollmentModel->enrollUser($data);
if ($insertId) {
// return course_id and title (title can be taken from POST data too)
return $this->response->setJSON(['status' => 'success', 'message' => 'Enrolled successfully', 'enrollment' => array_merge(['id' => $insertId], $data)]);
}


return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Failed to enroll']);
}
}