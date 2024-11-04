<?php

class User {
   use Model;

   protected $table = 'users';

   protected $allowedColumns = [
      'user_id',
      'name',
      'email',
      'password',
      'phone_number',
      'NIC',
      'role',
      'is_active',
      'created_at',
      'updated_at'
   ];
}