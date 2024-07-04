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
            // $file1Path = "c:\xampp\htdocs\tugas_akhir\writable\uploads\1.jpeg";
            // $file2Path = "c:\xampp\htdocs\tugas_akhir\writable\uploads\4.jpeg";

            $command = escapeshellcmd("python " . APPPATH . "python/compare_faces.py $file1Path $file2Path");
            $output = shell_exec($command);

            // Decode the JSON output from the Python script
            // $outputArray = json_decode($output, true);

            // Return the output using CodeIgniter's respond method
            return $this->respond($output);
        } else {
            return $this->respond(['status' => 'Gagal']);
        }
    }
}
