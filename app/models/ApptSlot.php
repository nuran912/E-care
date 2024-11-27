<?php

class ApptSlot {
   use Model;

   protected $table = 'availabletimes';

   protected $allowedColumns = [
      'apptId',
      'hospital',
      'date',
      'time',
      'doctorId'
   ];

   public $order_column = 'time';
}