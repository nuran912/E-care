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
            'document_name',
            'uploaded_at'
        ]; 
        public function getDocumentsByUserId($id){
            $query = "SELECT * FROM $this->table WHERE user_id = :user_id ";
            $result = $this->query($query, ['user_id' => $id]);
            return $result ? $result : null;
        }
    }
    