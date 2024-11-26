<?php

    class Document {
        use Model;

        protected $table = 'documents';
        protected $order_column = "uploaded_at";
        protected $order_type = 'desc';

        protected $allowedColumns = [
            'document_id',
            'user_id',
            'uploaded_by',
            'document_type',
            'document_name',
            'uploaded_at'
        ]; 
    }