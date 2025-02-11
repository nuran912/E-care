<?php

class InsuranceClaim
{
   use Model;

   protected $table = 'insuranceclaims';

   protected $allowedColumns = [
      'claim_id',
      'user_id',
      'insurance_company_id',
      'document_id',
      'hospital',
      'name_of_policy_holder',
      'relationship_to_policy_holder',
      'claim_type',
      'policy_number',
      'NIC_of_policy_holder',
      'member_number',
      'policy_holder_contact_number',
      'bank_details',
      'patient_full_name',
      'email',
      'relavant_documents',
      'claim_status',
      'submitted_at'
   ];

   public $order_column = 'company_name';
}
