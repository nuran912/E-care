<?php

class Clerk extends Controller {

    public function recordClerkUploadDoc() {

        $this->view('header');

        $document = new Document;

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {

            $user_id = $_POST['patientID'];
            $uploaded_by = $_POST['uploaded_by'];
            $document_type = 'medical_record';
            $document_category = $_POST['docCategory'];
            $ref_no = $_POST['ref_no'];

            //target directory
            $targetDir = "assets/documents/";

            //check if the file was uploaded
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $filename = basename($_FILES['file']['name']);
                $targetPath = $targetDir . $filename;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                //moving the file to the target path
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
                    //moved successfully
                    $data = [
                        'user_id' => $user_id,
                        'uploaded_by' => $uploaded_by,
                        'document_type' => $document_type,
                        'document_category' => $document_category,
                        'document_name' => $filename,
                        'ref_no' => $ref_no
                    ];

                    $document->insert($data);

                    redirect('Clerk/recordClerkWorkLog');
                }
            }
        }

        $this->view('Clerk/recordClerkUploadDoc');
        $this->view('footer');
    }

    public function recordClerkWorkLog() {

        $this->view('header');

        $document = new Document;

        $document->setLimit(50);
        $document->setOrder('desc');
        $documents = $document->findAll();

        $data = [
            'documents' => $documents
        ];

        $this->view('Clerk/recordClerkWorkLog',$data);
        $this->view('footer');
    }

    public function labClerkUploadDoc() {

        $this->view('header');

        $document = new Document;

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {

            $user_id = $_POST['patientID'];
            $uploaded_by = $_POST['uploaded_by'];
            $document_type = 'lab_report';
            $document_category = $_POST['docCategory'];
            $ref_no = $_POST['ref_no'];

            //target directory
            $targetDir = "assets/documents/";

            //check if the file was uploaded
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $filename = basename($_FILES['file']['name']);
                $targetPath = $targetDir . $filename;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                //moving the file to the target path
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
                    //moved successfully
                    $data = [
                        'user_id' => $user_id,
                        'uploaded_by' => $uploaded_by,
                        'document_type' => $document_type,
                        'document_category' => $document_category,
                        'document_name' => $filename,
                        'ref_no' => $ref_no
                    ];

                    $document->insert($data);

                    redirect('Clerk/labClerkWorkLog');
                }
            }
        }

        $this->view('Clerk/labClerkUploadDoc');
        $this->view('footer');
    }

    public function labClerkWorkLog() {
        
        $this->view('header');

        $document = new Document;

        $document->setLimit(50);
        $document->setOrder('desc');
        $documents = $document->findAll();

        $data = [
            'documents' => $documents
        ];

        $this->view('Clerk/labClerkWorkLog',$data);
        $this->view('footer');
    }
}

?>