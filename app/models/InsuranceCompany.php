<?php

class InsuranceCompany
{
   use Model;

   protected $table = 'insurancecompanies';

   protected $allowedColumns = [
      'insurance_company_id',
      'company_name',
      'website_link',
      'number',
      'email',
      'logo',
      'created_at',
      'updated_at'
   ];

   public $order_column = 'company_name';

   public function countAllInsuranceCompanies(){
      $sql = "SELECT COUNT(*) as total FROM $this->table";
      $result = $this->query($sql);
      return $result ? $result[0]->total : 0;
   }
   
}
