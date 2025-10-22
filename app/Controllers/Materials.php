namespace App\Controllers;

use App\Models\MaterialModel;
use CodeIgniter\Controller;

class Materials extends Controller
{
    public function upload($courseId)
    {
        helper(['form', 'url']);

        // POST = upload file
        if ($this->request->getMethod() === 'post') {
            $file  = $this->request->getFile('file');
            $title = $this->request->getPost('title');

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/', $newName);

                $model = new MaterialModel();
                $model->insert([
                    'course_id'  => $courseId,
                    'file_name'  => $title,
                    'file_path'  => 'uploads/' . $newName,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                return redirect()->to("/admin/course/{$courseId}/upload")
                                 ->with('success', 'Material uploaded successfully!');
            }

            return redirect()->to("/admin/course/{$courseId}/upload")
                             ->with('error', 'Upload failed. Please try again.');
        }

        // GET = show upload page
        return view('materials/upload', ['courseId' => $courseId]);
    }
}
