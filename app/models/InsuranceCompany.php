<?php

class InsuranceCompany {
   use Model;

   protected $table = 'insurancecompanies';

   protected $allowedColumns = [
      'insurance_company_id',
      'company_name',
      'website_link',
      'number',
      'email',
      'log0',
      'created_at',
      'updated_at'
   ];

   public $order_column = 'company_name';
}