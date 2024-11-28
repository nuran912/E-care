<?php

    class Patient extends Controller {
        
        public function documents($a = '',$b = '',$c = '') {

            $this->view('header');

            $document = new Document;
            $document->setOrder('desc');

            //insert a private file
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
                $user_id = $_POST['user_id'];
                $uploaded_by = $_POST['uploaded_by'];
                $document_type = $_POST['document_type'];

                //target directory
                $targetDir = "assets/documents/";

                //check if the file was uploaded
                if(isset($_FILES['real-file']) && $_FILES['real-file']['error'] == 0) {
                    $filename = basename($_FILES['real-file']['name']);
                    $targetPath = $targetDir . $filename;

                    if(!is_dir($targetDir)) {
                        mkdir($targetDir,0777,true);
                    }

                    //moving the file to the target path
                    if(move_uploaded_file($_FILES['real-file']['tmp_name'],$targetPath)) {
                        //moved successfully
                        $data = [
                            'user_id' => $user_id,
                            'uploaded_by' => $uploaded_by,
                            'document_type' => $document_type,
                            'document_name' => $filename
                        ];

                        $document->insert($data);
                        redirect('patient/documents');
                    }
                }  
            }

            //update the name of a private file
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                
                $document_id = htmlspecialchars($_POST['document_id']);
                $new_document_name = htmlspecialchars($_POST['document_name']);

                //fetch the current document details
                $query = "SELECT * FROM documents WHERE document_id = $document_id LIMIT 1";
                $current_document = $document->get_row($query);

                $current_document_name = $current_document->document_name;

                $targetDir = "assets/documents/";

                $old_path = $targetDir . $current_document_name;
                $new_path = $targetDir . $new_document_name;

                //rename the file in the directory
                if(file_exists($old_path)) {
                    if(rename($old_path,$new_path)) {
                        $data = [
                            'document_name' => $new_document_name
                        ];
                        $document->update($document_id,$data,'document_id');
                    }
                }

                redirect('Patient/documents');
            }

            //delete a private file
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
                
                $document_id = htmlspecialchars($_POST['document_id']);
                $document_name = htmlspecialchars($_POST['document_name']);

                $document_path = "assets/documents/" . $document_name;

                if(file_exists($document_path)) {
                    if(unlink($document_path)) {
                        $document->delete($document_id,'document_id');
                        unset($_POST);
                    }
                }

                redirect('patient/documents');
            }

            //retrieve the documents from the database
            $document->setLimit(50);
            $documents = $document->findAll();

            $data = [
                'documents' => $documents
            ];

            $this->view('Patient/documents',$data);

            $this->view('footer');
        }

        public function insuranceclaims($a = '',$b = '', $c = '') {
            $this->view('header');
            $this->view('Patient/insurance_claim');
            $this->view('footer');
        }
    }