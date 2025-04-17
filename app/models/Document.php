<?php

    class Document {
        use Model;

        protected $table = 'documents';
        protected $order_column = "uploaded_at";
        // protected $order_type = 'desc';

        protected $allowedColumns = [
            'document_id',
            'user_id',
            'uploaded_by',
            'document_type',
            'document_category',
            'document_name',
            'ref_no',
            'uploaded_at'
        ]; 

        public function getDocumentsByUserId($id){
            $query = "SELECT * FROM $this->table WHERE user_id = :user_id ";
            $result = $this->query($query, ['user_id' => $id]);
            return $result ? $result : null;
        }
        public function getDocumentById($document_id){
            $query = 'SELECT * FROM documents WHERE document_id = :document_id';
            $result = $this->query($query, ['document_id'=> $document_id]);
            return $result ? $result[0] : null;
        }

        public function getDocuments($user_id) {
            if(empty($user_id)) {
               return [];
            }
      
            $query = "SELECT * FROM $this->table WHERE user_id = :user_id";
      
            $result = $this->query($query,['user_id' => $user_id]);
            
            return json_decode(json_encode($result), true); // Convert object to array
        }

        public function getAllDocuments() {
      
            $query = "SELECT * FROM $this->table";
      
            $result = $this->query($query);
            
            return json_decode(json_encode($result), true); // Convert object to array
         }
        public function getDocumentNamebyId($id){
            $query="SELECT document_name FROM $this->table WHERE document_id=:document_id";
            $result=$this->query($query,['document_id'=>$id]);
            return $result ? $result[0] :null;
        }
    }

