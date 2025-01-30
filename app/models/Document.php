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

        public function getDocumentById($document_id){
            $query = 'SELECT * FROM documents WHERE document_id = :document_id';
            $result = $this->query($query, ['document_id'=> $document_id]);
            return $result ? $result[0] : null;
        }
    }