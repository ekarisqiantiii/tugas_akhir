<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class FaceMatchController extends ResourceController
{
    public function match()
    {
        $file1 = $this->request->getFile('photo1');
        $file2 = $this->request->getFile('photo2');

        if ($file1->isValid() && !$file1->hasMoved() && $file2->isValid() && !$file2->hasMoved()) {
            $file1Path = WRITEPATH . 'uploads/' . $file1->getName();
            $file2Path = WRITEPATH . 'uploads/' . $file2->getName();
            $file1->move(WRITEPATH . 'uploads/');
            $file2->move(WRITEPATH . 'uploads/');

            $command = escapeshellcmd("python " . APPPATH . "python/compare_faces.py $file1Path $file2Path");
            $output = shell_exec($command);

            return $this->respond(json_decode($output));
        } else {
            return $this->respond(['status' => 'Gagal']);
        }
    }
}
